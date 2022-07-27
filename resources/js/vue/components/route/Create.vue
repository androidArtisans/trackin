<template>
    <div>
        <v-row>
            <v-col
             cols="6"
             offset="3"
            >
            
                <h2>{{ title }} Ruta</h2>
                <v-form
                ref="form"
                v-model="valid"
                lazy-validation
                >
                    <v-text-field
                    v-model="form.name"
                    :counter="50"
                    :rules="[v => !!v || 'Nombre is required']"
                    label="Nombre Ruta"
                    required
                    ></v-text-field>    
                    <v-text-field
                    v-model="form.lat_ini"
                    :counter="50"
                    :rules="[v => !!v || 'Latutud Inicial is required']"
                    label="Latitud Inicial"
                    required
                    ></v-text-field>
                    <v-text-field
                    v-model="form.ln_ini"
                    :counter="50"
                    :rules="[v => !!v || 'Lingitud Inicial is required']"
                    label="Longitud Inicial"
                    required
                    ></v-text-field>    
                    <v-text-field
                    v-model="form.lat_fin"
                    :counter="50"
                    :rules="[v => !!v || 'Latitud Destino is required']"
                    label="Latitud Destino"
                    required
                    ></v-text-field>    
                    <v-text-field
                    v-model="form.ln_fin"
                    :counter="50"
                    :rules="[v => !!v || 'Longitud Destino is required']"
                    label="Longitud Destino"
                    required
                    ></v-text-field>    

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

export default {
    data(){
        return {
            form:{
                name: "",
                lat_ini: "",
                ln_ini: "",
                lat_fin: "",
                ln_fin: "",
            },
            instance: '',
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
            
    },
    methods: {
        submit(){
            if(this.instance == ""){
                return this.$axios.post("/api/route",this.form).then(res=> {
                    this.$router.push({ name: 'listRoute' })
                }).catch(error => {
                    if(error.response.data.message)
                        console.log( error.response.data.message );
                });
            }
            //update
            this.$axios.put("/api/route/" + this.instance.id,this.form).then(res=> {
                this.$router.push({ name: 'listRoute' })
            }).catch(error => {
                if(error.response.data.message)
                    console.log(error.response.data);
            });
            
        },
        cancel(){
            this.$router.push({ name: 'listRoute' })
        },
        async getInstance(){
            this.instance = await this.$axios.get('/api/route/' + this.$route.params.slug);
            this.instance = this.instance.data;
        },
        initForm(){
            this.form.name = this.instance.name;
            this.form.lat_ini = this.instance.lat_ini;
            this.form.ln_ini = this.instance.ln_ini;
            this.form.lat_fin = this.instance.lat_fin;
            this.form.ln_fin = this.instance.ln_fin;
        }
    }
};
</script>