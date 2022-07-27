<template>
    <div>
        <v-row>
            <v-col
             cols="6"
             offset="3"
            >
            
                <h2>{{ title }} Viaje</h2>
                <v-form
                ref="form"
                v-model="valid"
                lazy-validation
                >
                    <v-text-field
                    v-model="form.code"
                    :counter="50"
                    :rules="[v => !!v || 'Código is required']"
                    label="Código de Viaje"
                    required
                    ></v-text-field>    
                    <v-select
                    :items="devices"
                    item-title="mac_address"
                    item-value="id"
                    v-model="form.device_id"
                    label="Dispositivo"
                    ></v-select>
                    <v-select
                    :items="routes"
                    item-title="name"
                    item-value="id"
                    v-model="form.route_id"
                    label="Tramo"
                    ></v-select>    
                    <Datepicker v-model="form.departure" placeholder="Salida" class="datetime" modelType="yyyy-MM-dd HH:mm"
                    >
                    </Datepicker>
                
                    <v-select
                    :items="status"
                    item-title="text"
                    item-value="value"
                    v-model="form.status"
                    label="Estado"
                    ></v-select>  

                    <v-btn
                    color="primary"
                    @click="submit"
                    >
                    Guardar
                    </v-btn>
                    <v-btn flat @click="cancel">
                    Cancelar
                    </v-btn>
                </v-form>
            </v-col>
        </v-row>  
    </div>
</template>

<script>
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
export default {
    components: { Datepicker },
    data(){
        return {
            form:{
                code: "",
                device_id: "",
                route_id: "",
                departure: "",
                status: ""
            },
            instance: '',
            devices: [],
            routes: [],
            status: [
                {
                    value: 'Pendiente',
                    text: 'Pendiente'
                },
                {
                    value: 'Iniciado',
                    text: 'Iniciado'
                },
                {
                    value: 'Concluido',
                    text: 'Concluido'
                },
            ],
            valid: true,
            title: "Crear"
        }
    },
    async mounted(){
        if(this.$route.params.slug){
            await this.getInstance();
            this.initForm();
            this.title = "Modificar" ;
        }

        this.$axios.get('/api/device').then((res) => {
            this.devices = res.data;
        })

        this.$axios.get('/api/route').then((res) => {
            this.routes = res.data;
        })
    },
    methods: {
        submit(){
            if(this.instance == ""){
                return this.$axios.post("/api/travel",this.form).then(res=> {
                    this.$router.push({ name: 'listTravel' })
                }).catch(error => {
                    if(error.response.data.message)
                        console.log( error.response.data.message );
                });
            }
            //update
            this.$axios.put("/api/travel/" + this.instance.id,this.form).then(res=> {
                this.$router.push({ name: 'listTravel' })
            }).catch(error => {
                if(error.response.data.message)
                    console.log(error.response.data);
            });
            
        },
        cancel(){
            this.$router.push({ name: 'listTravel' })
        },
        async getInstance(){
            this.instance = await this.$axios.get('/api/travel/' + this.$route.params.slug);
            this.instance = this.instance.data;
        },
        initForm(){
            this.form.code = this.instance.code;
            this.form.device_id = this.instance.device_id;
            this.form.route_id = this.instance.route_id;
            this.form.departure = this.instance.departure;
            this.form.status = this.instance.status;
        }
    }
};
</script>