<template>
    <div>
        <h1>Lista de Dispositivos
        
            <router-link :to="{ name: 'create' }">
            <v-btn
            :rounded="0"
            color="primary"
            size="small"
            prepend-icon="mdi-plus-box"
            >Nuevo
            </v-btn></router-link>
            
        </h1>
        

        <!--<o-table :data="devices.length == 0 ? [] : devices" >
            <o-table-column field = "id" label = "ID" numeric v-slot="p">
                {{ p.row.id }}
            </o-table-column>
            <o-table-column field = "code" label = "Mac Address" v-slot="p">
                {{ p.row.mac_address }}
            </o-table-column>
            <o-table-column field = "type" label = "Tipo" v-slot="p">
                {{ p.row.type }}
            </o-table-column>
            <o-table-column field = "slug" label = "Acciones" v-slot="p">
                <router-link :to="{ name: 'create', params: {'slug': p.row.id} }">Edit</router-link>
                <o-button variant="danger" @click="deletePost(p)">Eliminar</o-button>
            </o-table-column>
        </o-table>-->
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
                <td><router-link :to="{ name: 'create', params: {'slug':device.id} }">
                <v-icon color="blue darken-2" >mdi-pencil</v-icon>
                    
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

