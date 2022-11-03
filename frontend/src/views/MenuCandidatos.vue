<template>
    <div>
        <h1>Listado de prospectos</h1>
        <br>
        <div v-for="prospectos in prospectos" :key="prospectos.prospecto_id" align="center">
            <b-card style="max-width: 800px;">
                <b-card-title v-show="prospectos.apellido_materno != null">{{prospectos.nombre+' '+prospectos.apellido_paterno+' '+prospectos.apellido_materno}}</b-card-title>
                <b-card-title v-show="prospectos.apellido_materno == null">{{prospectos.nombre+' '+prospectos.apellido_paterno}}</b-card-title>
                <b-card-sub-title>Estatus: {{prospectos.estatus}}</b-card-sub-title>
                <b-card-text v-show="prospectos.observaciones !=null">
                    Observaciones: <br> {{prospectos.observaciones}}
                </b-card-text>
                <br>
                <b-button v-show="prospectos.estatus == 'Enviado'" :to="{name:'EvaluacionCandidatos', params:{data: prospectos.prospecto_id}}" variant="success">Revisar Solicitud</b-button>
            </b-card>
        </div>
        <b-button variant="info" to="/formulario">Registrar Nuevo</b-button>
    </div>
</template>
<script>
import axios from 'axios';
export default{
    name: "MenuCandidatos",
    data(){
        return{
            prospectos:[]
        }
    },
    created(){
        axios.get('http://127.0.0.1:8000/api/prospecto')
            .then(response => (this.prospectos = response.data))
    }
}
</script>