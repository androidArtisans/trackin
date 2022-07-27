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
                <th class="text-center">Salida</th>
                <th class="text-center">Estado</th>
                <th class="text-right">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="(travel, key) in travels"
                :key="travel.id"
            >
                <td>
                    <v-chip
                    class="ma-2"
                    >
                    {{ travel.code }}
                    </v-chip>
                </td>
                <td>{{ travel.route.name }}</td>
                <td class="text-center">{{ travel.departure }}</td>
                <td class="text-center">
                    <v-chip
                        class="ma-2"
                        color="primary"
                        label
                    >
                    <v-icon start icon="mdi-clock-outline"></v-icon>
                    {{ travel.status }}
                    </v-chip>
                </td>
                <td class="text-right">
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

