<template>
    <div>
        <h2>Dispositivos
            <router-link :to="{ name: 'create' }" custom>
            <v-btn
            :rounded="0"
            color="primary"
            size="small"
            prepend-icon="mdi-plus-box"
            >Nuevo
            </v-btn></router-link>
            
        </h2>
    
        <v-table>
            <thead>
            <tr>
                <th class="text-left">Mac Address</th>
                <th class="text-left">Tipo</th>
                <th class="text-left">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="device in devices"
                :key="device.id"
            >
                <td>{{ device.mac_address }}</td>
                <td>{{ device.type }}</td>
                <td><router-link :to="{ name: 'create', params: {'slug':device.id} }" custom v-slot="{ navigate }" >
                <v-icon @click="navigate" color="blue-grey darken-2" role="link" >mdi-pencil</v-icon>
                    
                </router-link>
         
                <v-icon color='blue-grey darken-2' @click="deletePost(p)" >mdi-delete</v-icon>
                   </td> 
                
            </tr>
            </tbody>
        </v-table>
    </div>
</template>

<script>
  export default {
    data() {
        return {
            devices : [],
            loading : true
        }
    },
    async mounted() {
        this.$axios.get('/api/device').then((res) => {
            this.devices = res.data;
            console.log(this.devices);
            this.loading = false;
        })
    },
    methods:{
        deletePost(row){
            //console.log(device);
            this.devices.splice(row.index,1);
            this.$axios.delete('/api/device/' + row.row.id);
        }
    }
  }
</script>

