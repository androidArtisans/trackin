<template>
    <b-container>
        <!--<form @submit.prevent="submit">
            <o-field label="Mac Address" :variant="errors.mac_address ? 'danger' : 'primary'" :message="errors.mac_address">
                <o-input v-model="form.mac_address" value="" placeholder="Ingrese la mac address del equipo"></o-input>
            </o-field>
            <o-field label="Tipo" >
                <o-input v-model="form.type" value="" placeholder="Ingrese el tipo de dispositivo"></o-input>
            </o-field>
            <o-button variant="primary" native-type="submit" >Guardar</o-button>
        </form>-->
        <v-row>
            <v-col
             cols="6"
             offset="3"
         
            >
            
        <h2>Create</h2>
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
            :rules="[v => !!v || 'Item is required']"
            label="Tipo"
            required

            ></v-text-field>    

            <v-btn
            color="primary"
            @click="save"
            
            >
            Guardar
            </v-btn>
            <v-btn flat @click="cancel">
            Cancelar
            </v-btn>
        </v-form>
            </v-col>
        </v-row>
        
        
    </b-container>
</template>

<script>
//import { then } from 'laravel-mix';

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
            nameRules: [
                v => !!v || 'Mac Address is required',
                v => (v && v.length <= 50) || 'Name must be less than 10 characters',
            ],
        }
    },
    async mounted(){
        //console.log(this.$route.params.slug);
        if(this.$route.params.slug){
            await this.getPost();
            console.log(this.post);
            this.initPost();
        }
            
    },
    methods: {
        cleanErrorsForm(){
            this.errors.mac_address = "";
        },
        save(){
            this.cleanErrorsForm();

            if(this.post == ""){
                return this.$axios.post("/api/device",
                    this.form
                ).then(res=> {
                    console.log(res)
                    this.$router.push('/vue');
                }).catch(error => {
                    console.log(error.response.data);
                    if(error.response.data.message)
                        this.errors.mac_address = error.response.data.message;
                });
            }
            //update
            this.$axios.put("/api/device/" + this.post.id,
                this.form
            ).then(res=> {
                this.$router.push('/vue');
            }).catch(error => {
                console.log(error.response.data);
                if(error.response.data.message)
                    this.errors.mac_address = error.response.data.message;
            });
            
        },
        cancel(){
            this.$router.push('/vue');
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