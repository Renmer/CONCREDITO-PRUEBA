<template>
    <div>
        <div>
        <h1>Captura de informacion del prospecto</h1>
            <h4><b>Informacion del prospecto</b></h4>
            <b-form-input id="input-1" v-model="prospecto.nombre" type="text" placeholder="Nombre" disabled></b-form-input>
            <b-form-input id="input-2" v-model="prospecto.apellido_paterno" type="text" placeholder="Apellido paterno" disabled></b-form-input>
            <b-form-input id="input-3" v-model="prospecto.apellido_materno" type="text" placeholder="Apellido materno" disabled></b-form-input>
            <b-form-input id="input-9" v-model="prospecto.rfc" type="text" placeholder="RFC" disabled></b-form-input>
            <br>
            <h4><b>Domicilio del prospecto</b></h4>
            <b-form-input id="input-4" v-model="prospecto.calle" type="text" placeholder="Calle" disabled></b-form-input>
            <b-form-input id="input-5" v-model="prospecto.numero" type="text" placeholder="Numero" disabled></b-form-input>
            <b-form-input id="input-6" v-model="prospecto.colonia" type="text" placeholder="Colonia" disabled></b-form-input>
            <b-form-input id="input-7" v-model="prospecto.codigo_postal" type="text" placeholder="Codigo Postal" disabled></b-form-input>

            <br>
            <h4><b>Numero de contacto</b></h4>
            <b-form-input id="input-8" v-model="prospecto.telefono" type="text" placeholder="Telefono" disabled></b-form-input>

            <br>
            <h4><b>Documentos del prospecto</b></h4>
            <div v-for="prospectos in prospecto.documento" :key="prospectos.nombre">
                <b-button @click="llamada_documento(prospectos.ruta, prospectos.nombre)" variant="warning">{{prospectos.nombre}}</b-button>
                <br>
            </div>
            <br>
            <b-button-group>
                <b-button to="/" variant="info">Regresar al inicio</b-button>
                <b-button variant="success" @click="aceptar">Aceptar prospecto</b-button>
                <b-button v-b-toggle.collapse-1 variant="danger">Rechazar prospecto</b-button>
            </b-button-group>
            <b-collapse id="collapse-1" class="mt-2">
                <b-card>
                    <p class="card-text">Observaciones:</p>
                    <b-form-textarea
                        id="textarea"
                        v-model="text"
                        placeholder="Ingrese las observaciones del prospecto"
                        rows="3"
                        max-rows="6"
                        ></b-form-textarea>
                    <br>
                    <b-button @click="rechazar" size="sm" variant="danger">Rechazar</b-button>
                </b-card>
            </b-collapse>
    </div>
    </div>
</template>

<script>
import axios from 'axios';
export default{
    
    name: "EvaluacionCandidatos",
    data(){
        return{
            prospecto_id: this.$route.params.data,
            archivos: null,
            prospecto:'',
            url:null,
            estatus:null,
            text:''
        }
    },
    created(){
        axios.get('http://127.0.0.1:8000/api/prospecto/'+this.prospecto_id)
            .then(response => (this.prospecto = response.data))
    },
    methods:{
        descarga(response, title) {
            const url = window.URL.createObjectURL(new Blob([response.data]))
            const link = document.createElement('a')
            link.href = url
            link.setAttribute('download', title)
            document.body.appendChild(link)
            link.click()
        },
        llamada_documento(url, title) {
            this.url={"url":url}
            axios.post('http://127.0.0.1:8000/api/archivo/',this.url, {responseType: 'blob'})
                .then((response) => (this.descarga(response, title)))
        },
        rechazar(){
            this.estatus={
                "prospecto_id":this.prospecto.prospecto_id,
                "estatus": "Rechazado",
                "observaciones": this.text
            }
            axios.post('http://127.0.0.1:8000/api/estatus/',this.estatus)
                .then(response => {
                    console.log(response)
                    this.$router.push({ name: 'MenuCandidatos',})
                })
        },
        aceptar(){
            this.estatus={
                "prospecto_id":this.prospecto.prospecto_id,
                "estatus": "Autorizado",
                "observaciones": null
            }
            axios.post('http://127.0.0.1:8000/api/estatus/',this.estatus)
                .then(response => {
                    console.log(response)
                    this.$router.push({ name: 'MenuCandidatos'})
                })

        }
    }
}
</script>