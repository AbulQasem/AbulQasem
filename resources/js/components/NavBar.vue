<template>
  <v-toolbar
    dark
  >
    <v-toolbar-title>Escuela de Árabe de Zaragoza</v-toolbar-title>

    <v-divider
      class="mx-4"
      vertical
    ></v-divider>


    <v-spacer></v-spacer>

    <categories></categories>

    <v-app-bar-nav-icon></v-app-bar-nav-icon>
  </v-toolbar>
</template>

<script>
import Categories from "./Categories.vue";
export default {
    components: { Categories },
    name: "nav-bar",

};
</script>
