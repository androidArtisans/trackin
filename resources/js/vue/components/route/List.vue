<template>
    <div>
        <h2>Rutas
            <router-link :to="{ name: 'createRoute' }" custom v-slot="{ navigate }">
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
                <th class="text-left">Latitud Origen</th>
                <th class="text-left">Longitud Origen</th>
                <th class="text-left">Latitud Destino</th>
                <th class="text-left">Longitud Destino</th>
                <th class="text-left">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="(route, key) in routes"
                :key="route.id"
            >
                <td>{{ route.name }}</td>
                <td>{{ route.lat_ini }}</td>
                <td>{{ route.ln_ini }}</td>
                <td>{{ route.lat_fin }}</td>
                <td>{{ route.ln_fin }}</td>
                
                <td>
                    <router-link :to="{ name: 'createRoute', params: {'slug':route.id} }" custom v-slot="{ navigate }" >
                        <v-icon @click="navigate" color="blue-grey darken-2" role="link" >mdi-pencil</v-icon>
                    </router-link>
         
                    <v-icon color='blue-grey darken-2' @click="delete(route.id, key)" >mdi-delete</v-icon>
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
            routes : [],
            loading : true
        }
    },
    async mounted() {
        this.$axios.get('/api/route').then((res) => {
            this.routes = res.data;
            this.loading = false;
        })
    },
    methods:{
        delete(id, index){
            this.routes.splice(index,1);
            this.$axios.delete('/api/route/' + id);
        }
    }
  }
</script>

