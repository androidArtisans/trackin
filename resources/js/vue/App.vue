<template>
    <!--<div>
        <router-view></router-view>
    </div>-->
    <v-app>
      <v-navigation-drawer
        expand-on-hover
        rail
        theme="dark"
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
          <v-list-item prepend-icon="mdi-folder" title="Dispositivos" value="myfiles"></v-list-item>
          <v-list-item prepend-icon="mdi-account-multiple" title="Mapa" value="shared"></v-list-item>
          <v-list-item prepend-icon="mdi-star" title="Detalle" value="starred"></v-list-item>
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
    //
  }
</script>
