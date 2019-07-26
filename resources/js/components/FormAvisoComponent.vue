<template>

    <form  @submit.prevent="createAviso">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Título <small><u></u></small></label>
                            <input v-model='titulo' class="form-control" type="text" name="titulo">
                        </div>

                    </div>
                </div> 

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div>
                                <label>Descrição <small><u></u></small></label>
                                <textarea class="form-control" name="descricao" v-model="descricao" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <div>
                                <label>Cor do cartão de aviso</label>
                                <select v-model="cor" class="form-control select-2" name="color">
                                    <option value="danger">Vermelho</option>
                                    <option value="info" >Azul Escuro</option>
                                    <option value="primary" >Azul Claro</option>
                                    <option value="default" >Preto</option>
                                    <option value="secondary">Roxo</option>
                                    <option value="success" > Verde</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div>
                                <label>Setor <small><u>(Deixe vazio caso queira mandar para todos setores)</u></small></label>
                                <select v-model="aviso.setor_id" class="form-control select-2" name="setor_id">
                                    <option value=""></option>
                                    <option v-for="setor in setores" :value="setor.id">{{setor.name}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div>
                                <label>Data de Início</label>
                                <input v-model="aviso.data_inicio" type="date" class="form-control" name="data_inicio" >
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Data de Término</label>
                            <input v-model="aviso.data_fim" type="date" class="form-control" name="data_fim" >
                        </div>
                    </div>
                </div> 
            </div>

            <div class="col-md-6">
                <h3>Prévia do Aviso</h3>
                <div :class="'card card-info bg-' + cor + '-gradient card-annoucement card-round'">
                    <div class="card-body text-center">
                        <div class="card-opening">
                            {{titulo}}
                        </div>
                        <div class="card-desc">
                            <span v-html="descricao"></span>
                        </div>
                        <div class="card-detail">

                        </div>
                    </div>
                </div>

            </div>


        </div>

        <button
        :class="{ disabled: (!titulo || !descricao) }"
        class="btn btn-primary">
        Salvar
    </button>
</form>
</template>
<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
<script>
    export default {
        props:['aviso','setores'],
        mounted(){
            // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
        },
        data: function(){
            return {
                titulo: this.aviso.titulo,
                descricao: this.aviso.descricao,
                cor: this.aviso.color
            }
        },
        watch:{
            titulo:function(val){
                this.titulo = val;
            },
            descricao:function(val){
                this.descricao = val;
            },
            cor:function(val){
                this.cor = val;
            }
        },
        methods: {
            createAviso() {
                if(!this.titulo || !this.descricao)
                    return;
                var aviso = Object();

                aviso['titulo'] = this.titulo;
                aviso['descricao']  =   this.descricao;
                aviso['color']    =   this.cor;
                aviso['data_fim']   =   this.aviso.data_fim;
                aviso['data_inicio']   =   this.aviso.data_inicio;
                aviso['setor_id']   =   this.aviso.setor_id;

                console.log(aviso);
                axios.post('/avisos', {
                    aviso
                }).then( response => {
                    if(response.data) { 
                        console.log(response.data);
                    }
                })
            },
            listenEvent() {

  
                Echo.channel('avisos')
                .listen('AvisoCadastrado', aviso => {
                    if (! ('Notification' in window)) {
                        alert('Web Notification is not supported');
                        return;
                    }
                    Notification.requestPermission( permission => {

                        let notification = new Notification('New post alert!', {
                            body: aviso.aviso.titulo
                        });

                        notification.onclick = () => {
                            window.open(window.location.href);
                        };
                    });
                });
            }
        },
        created() {
            this.listenEvent();
        },
    }
</script>
