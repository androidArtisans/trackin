<template>
    <div>
        <h2>Viajes
            <router-link :to="{ name: 'createTravel' }" custom v-slot="{ navigate }">
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
                <th class="text-left">Código</th>
                <th class="text-left">Tramo</th>
                <th class="text-left">Salida</th>
                <th class="text-left">Estado</th>
                <th class="text-left">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="(travel, key) in travels"
                :key="travel.id"
            >
                <td>{{ travel.code }}</td>
                <td>{{ travel.route.name }}</td>
                <td>{{ travel.departure }}</td>
                <td>{{ travel.status }}</td>
                
                <td>
                    <router-link :to="{ name: 'createTravel', params: {'slug':travel.id} }" custom v-slot="{ navigate }" >
                        <v-icon @click="navigate" color="blue-grey darken-2" role="link" >mdi-pencil</v-icon>
                    </router-link>
         
                    <v-icon color='blue-grey darken-2' @click="delete(travel.id, key)" >mdi-delete</v-icon>
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
            travels : [],
            loading : true
        }
    },
    async mounted() {
        this.$axios.get('/api/travel').then((res) => {
            this.travels = res.data;
            this.loading = false;
        })
    },
    methods:{
        delete(id, index){
            this.travels.splice(index,1);
            this.$axios.delete('/api/travel/' + id);
        }
    }
  }
</script>

