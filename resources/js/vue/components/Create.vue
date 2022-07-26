<template>
    <div>
        <h1>Create</h1>
        <form @submit.prevent="submit">
            <o-field label="Mac Address" :variant="errors.mac_address ? 'danger' : 'primary'" :message="errors.mac_address">
                <o-input v-model="form.mac_address" value="" placeholder="Ingrese la mac address del equipo"></o-input>
            </o-field>
            <o-field label="Tipo" >
                <o-input v-model="form.type" value="" placeholder="Ingrese el tipo de dispositivo"></o-input>
            </o-field>
            <o-button variant="primary" native-type="submit" >Guardar</o-button>
        </form>
        
    </div>
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
            post: ''
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
        submit(){
            this.cleanErrorsForm();

            if(this.post == ""){
                return this.$axios.post("/api/device",
                    this.form
                ).then(res=> {
                    console.log(res)
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
                console.log(res)
            }).catch(error => {
                console.log(error.response.data);
                if(error.response.data.message)
                    this.errors.mac_address = error.response.data.message;
            });
            
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