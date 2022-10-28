<template>
    <div>
        <h1>Captura de informacion del prospecto</h1>
        <b-form @submit="enviar">

            <b-form-input id="input-1" v-model="form.nombre" type="text" placeholder="Nombre (requerido)" required></b-form-input>
            <b-form-input id="input-2" v-model="form.paterno" type="text" placeholder="Apellido paterno (requerido)" required></b-form-input>
            <b-form-input id="input-3" v-model="form.materno" type="text" placeholder="Apellido materno"></b-form-input>

            <br>

            <b-form-input id="input-4" v-model="form.calle" type="text" placeholder="Calle (requerido)" required></b-form-input>
            <b-form-input id="input-5" v-model="form.numero" type="text" placeholder="Numero (requerido)" required></b-form-input>
            <b-form-input id="input-6" v-model="form.colonia" type="text" placeholder="Colonia (requerido)" required></b-form-input>
            <b-form-input id="input-7" v-model="form.cp" type="text" placeholder="Codigo Postal (requerido)" required></b-form-input>

            <br>

            <b-form-input id="input-8" v-model="form.telefono" type="text" placeholder="Telefono (requerido)" required></b-form-input>
            <b-form-input id="input-9" v-model="form.rfc" type="text" placeholder="RFC (requerido)" required></b-form-input>

            <br>

            <b-form-file v-model="archivos" :state="Boolean(archivos)" placeholder="Seleccione o arrastre los archivos" drop-placeholder="Arrastre aquí" required/>
            <div class="mt-3">Archivos seleccionados: {{ archivos ? archivos.name : '' }}</div>

            <br>
            
            <b-button-group>
                <b-button type="submit" variant="success">Enviar</b-button>
                <b-button variant="warning" @click="salir">Regresar al inicio</b-button>
            </b-button-group>
        </b-form>

        <b-card class="mt-3" header="Form Data Result">
            <pre class="m-0">{{ form }}</pre>
        </b-card>
    </div>
</template>

<script>
export default{
    data(){
        return{
            form: {
                nombre:'',
                paterno:'',
                materno:'',
                calle:'',
                numero:'',
                colonia:'',
                cp:'',
                telefono:'',
                rfc:'',
            },
            archivos: null
        }
    },
    methods:{
        enviar(){
            alert('enviado')
        },
        salir(){
            if (confirm("Si sale perdera los datos capturados")) 
            {
                window.location.href = "/"
            }
        }
    }
}
</script>