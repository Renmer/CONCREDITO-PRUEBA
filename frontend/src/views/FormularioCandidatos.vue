<template>
    <div>
        <h1>Captura de informacion del prospecto</h1>
        <b-form @submit.prevent="enviar">
            <h4><b>Informacion del prospecto</b></h4>
            <b-form-input id="input-1" v-model="formData.nombre" type="text" placeholder="Nombre (requerido)" required></b-form-input>
            <b-form-input id="input-2" v-model="formData.apellido_paterno" type="text" placeholder="Apellido paterno (requerido)" required></b-form-input>
            <b-form-input id="input-3" v-model="formData.apellido_materno" type="text" placeholder="Apellido materno"></b-form-input>
            <b-form-input id="input-9" v-model="formData.rfc" type="text" placeholder="RFC (requerido)" required></b-form-input>
            <br>
            <h4><b>Domicilio del prospecto</b></h4>
            <b-form-input id="input-4" v-model="formData.calle" type="text" placeholder="Calle (requerido)" required></b-form-input>
            <b-form-input id="input-5" v-model="formData.numero" type="number" placeholder="Numero (requerido)" required></b-form-input>
            <b-form-input id="input-6" v-model="formData.colonia" type="text" placeholder="Colonia (requerido)" required></b-form-input>
            <b-form-input id="input-7" v-model="formData.codigo_postal" type="number" placeholder="Codigo Postal (requerido)" required></b-form-input>

            <br>
            <h4><b>Numero de contacto</b></h4>
            <b-form-input id="input-8" v-model="formData.telefono" type="number" placeholder="Telefono (requerido)" required></b-form-input>

            <br>
            <h4><b>Seleccion de archivos</b></h4>
            <input accept=".jpg, .png, .pdf" type="file" ref="file" @change="evento_archivo" multiple required>

            <br>
            <br>
            <b-button-group>
                <b-button type="submit" variant="success">Enviar</b-button>
                <b-button variant="warning" @click="salir">Regresar al inicio</b-button>
            </b-button-group>
        </b-form>
    </div>
</template>
<script>
import axios from 'axios';
export default{
    name: "FormularioCandidatos",
    data(){
        return{
            formData: {
                nombre:'',
                apellido_paterno:'',
                apellido_materno:'',
                calle:'',
                numero:'',
                colonia:'',
                codigo_postal:'',
                telefono:'',
                rfc:'',
            },
            attachments:[],
        }
    },
    methods:{
        enviar(){
            let formulario = new FormData()
            for(let i=0; i<this.attachments.length;i++){
                formulario.append('documentos[]',this.attachments[i]);
            }
            formulario.append('nombre',this.formData.nombre);
            formulario.append('apellido_paterno',this.formData.apellido_paterno);
            formulario.append('apellido_materno',this.formData.apellido_materno);
            formulario.append('calle',this.formData.calle);
            formulario.append('numero',this.formData.numero);
            formulario.append('colonia',this.formData.colonia);
            formulario.append('codigo_postal',this.formData.codigo_postal);
            formulario.append('telefono',this.formData.telefono);
            formulario.append('rfc',this.formData.rfc);
            
            axios.post('http://127.0.0.1:8000/api/prospecto',formulario,{
                headers: {
                    'Content-Type': "multipart/form-data"
                }
            })
            .then(respuesta=>{
                console.log(respuesta)
                this.$router.push({ name: 'MenuCandidatos', query: { redirect: '/' } })
            })
            .catch(error =>{
                console.log(error.data)
            })
            
        },
        salir(){
            if (confirm("Si sale perdera los datos capturados")) 
            {
                this.$router.push({ name: 'MenuCandidatos', query: { redirect: '/' } })
            }
        },
        evento_archivo(e){
            let selectedFiles=e.target.files;

            if(!selectedFiles.length){
                return false;
            }

            for(let i=0; i<selectedFiles.length; i++){
                this.attachments.push(selectedFiles[i]);
            }
        }
    
    }
}
</script>