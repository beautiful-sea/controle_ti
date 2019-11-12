<template>
    <div >

        <div class="form-group">
            <label>Para qual setor deseja encaminhar a OS?</label>
            <select v-model="setor" name="para_setor_ti" class="form-control select-2">
                <option value="1">TI</option>
                <option value="0">Manutenção</option>
            </select>
        </div>

        <div class="form-group">
            <label>O suporte será em qual equipamento?</label>
            <select name="equipamento_id" class="form-control select-2">
                <option :value="e.id" v-for="e in equipamentosTI" >
                    {{e.etiqueta}}
                </option>
            </select>
        </div>

    </div>
</template>

<script>
    export default {
        props:['equipamentos','ordem_servico','usuario'],
        data(){
            return {
                setor: 1
            }
        },
        computed:{
            equipamentosTI: function(){
                var setor = this.setor;
                return this.equipamentos.filter(function(e){
                    return e.pertence_ao_ti == setor
                });
            }
        },
        mounted() {

        }
    }
</script>