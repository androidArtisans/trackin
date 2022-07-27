<template>
    <div>
        <v-row>
            <v-col
             cols="6"
             offset="3"
         
            >
            
        <h2>{{ title }} Dispositivo</h2>
            <v-form
        ref="form"
        v-model="valid"
        lazy-validation
        >
            <v-text-field
            v-model="form.mac_address"
            :counter="50"
            :rules="macRules"
            label="Mac Address"
            required
            ></v-text-field>    
            <v-text-field
            v-model="form.type"
            :counter="50"
            :rules="[v => !!v || 'Tipo is required']"
            label="Tipo"
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
import { Field, Form } from 'vee-validate'

export default {
    data(){
        return {
            form:{
                mac_address: "",
                type: ""
            },
            errors:{
                mac_address: "",
                type: ""
            },
            post: '',
            valid: true,
            macRules: [
                v => !!v || 'Mac Address is required',
                v => (v && v.length <= 50) || 'Name must be less than 10 characters',
            ],
            title: "Crear"
        }
    },
    async mounted(){
        //console.log(this.$route.params.slug);
        if(this.$route.params.slug){
            await this.getPost();
            this.initPost();
            this.title = "Modificar" ;
        }
            
    },
    methods: {
        cleanErrorsForm(){
            this.errors.mac_address = "";
        },
        submit(){
            this.cleanErrorsForm();

            if(this.post == ""){
                return this.$axios.post("/api/device",
                    this.form
                ).then(res=> {
                    this.$router.push({ name: 'list' })
                }).catch(error => {
                    if(error.response.data.message)
                        this.errors.mac_address = error.response.data.message;
                });
            }
            //update
            this.$axios.put("/api/device/" + this.post.id,
                this.form
            ).then(res=> {
                this.$router.push({ name: 'list' })
            }).catch(error => {
                console.log(error.response.data);
                if(error.response.data.message)
                    this.errors.mac_address = error.response.data.message;
            });
            
        },
        cancel(){
            this.$router.push({ name: 'list' })
        },
        async getPost(){
            this.post = await this.$axios.get('/api/device/' + this.$route.params.slug);
            this.post = this.post.data;
        },
        initPost(){
            this.form.mac_address = this.post.mac_address;
            this.form.type = this.post.type;
        }
    }
};
</script>