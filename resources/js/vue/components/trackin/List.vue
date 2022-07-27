<template>
    <div>
        <h2>Viajes</h2>
    
        <v-table>
            <thead>
            <tr>
                <th class="text-left">Viaje</th>
                <th class="text-left">Tramo</th>
                <th class="text-center">Latitud</th>
                <th class="text-lefcentert">Longitud</th>
                <th class="text-left">Mensaje</th>
                <th class="text-center">Tipo Mensaje</th>
                <th class="text-right">Fecha Registro</th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="trakin in trakins"
                :key="trakin.id"
            >
                <td>{{ trakin.travel.code }}</td>
                <td>{{ trakin.travel.route.name }}</td>
                <td>{{ trakin.latitude }}</td>
                <td>{{ trakin.logitude }}</td>
                <td>{{ trakin.message }}</td>
                <td>{{ trakin.message_type }}</td>
                <td>{{ trakin.register_point_date }}</td>
                
            </tr>
            </tbody>
        </v-table>
    </div>
</template>

<script>
  export default {
    data() {
        return {
            trakins : [],
            loading : true
        }
    },
    async mounted() {
        this.$axios.get('/api/trakin').then((res) => {
            this.trakins = res.data;
            this.loading = false;
        })
    }
  }
</script>

