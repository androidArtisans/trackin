<template>
    <!--<div>
        <router-view></router-view>
    </div>-->
    <v-app>
        <v-app-bar
        color="primary"
        prominent
      >
        <v-app-bar-nav-icon variant="text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

        <v-toolbar-title>Trackin</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn variant="text" icon="mdi-magnify"></v-btn>

        <v-btn variant="text" icon="mdi-filter"></v-btn>

        <v-btn variant="text" icon="mdi-dots-vertical"></v-btn>
      </v-app-bar>
      <v-navigation-drawer
        v-model="drawer"
        temporary
      >
        <v-list>
          <v-list-item
            prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg"
            title="Sandra Adams"
            subtitle="sandra_a88@gmailcom"
          ></v-list-item>
        </v-list>

        <v-divider></v-divider>

        <v-list density="compact" nav>
          <v-list-item prepend-icon="mdi-tablet-cellphone" title="Dispositivos" value="myfiles"></v-list-item>
            <v-list-item prepend-icon="mdi-map-marker-distance" title="Rutas" value="myfiles"></v-list-item>
          <v-list-item prepend-icon="mdi-map-search" title="Seguimiento" value="shared"></v-list-item>
          <v-list-item prepend-icon="mdi-message-processing" title="Mensajes" value="starred"></v-list-item>
        </v-list>
      </v-navigation-drawer>


        <!-- Sizes your content based upon application components -->
        <v-main>

            <!-- Provides the application the proper gutter -->
            <v-container fluid>

            <!-- If using vue-router -->
            <router-view></router-view>
            </v-container>
        </v-main>

        <v-footer padless>
            <v-col
            class="text-center"
            cols="12"
            >
            {{ new Date().getFullYear() }} — <strong>Artisans CBBA</strong>
            </v-col>
        </v-footer>
        </v-app>
</template>

<script>
  export default {
    data () {
      return {
        drawer: null,
      }
    },
  }
</script>
