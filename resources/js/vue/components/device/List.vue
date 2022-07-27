<template>
    <div>
        <h2>Dispositivos
            <router-link :to="{ name: 'create' }" custom v-slot="{ navigate }">
            <v-btn
            :rounded="0"
            color="primary"
            size="small"
            prepend-icon="mdi-plus-box"
            @click="navigate"
            >Nuevo
            </v-btn></router-link>
            
        </h2>
    
        <v-table>
            <thead>
            <tr>
                <th class="text-left">Nombre</th>
                <th class="text-left">Mac Address</th>
                <th class="text-center">Tipo</th>
                <th class="text-right">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="(device, key) in devices"
                :key="device.id"
            >
                <td>{{ device.name }}</td>
                <td>{{ device.mac_address }}</td>
                <td class="text-center">{{ device.type }}</td>
                <td class="text-right"><router-link :to="{ name: 'create', params: {'slug':device.id} }" custom v-slot="{ navigate }" >
                <v-icon @click="navigate" color="blue-grey darken-2" role="link" >mdi-pencil</v-icon>
                    
                </router-link>
         
                <v-icon color='blue-grey darken-2' @click="deletePost(device.id, key)" >mdi-delete</v-icon>
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
            this.loading = false;
        })
    },
    methods:{
        deletePost(id, index){
            this.devices.splice(index,1);
            this.$axios.delete('/api/device/' + id);
        }
    }
  }
</script>

