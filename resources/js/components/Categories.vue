<template lang="es">
            
    <v-toolbar-items class="hidden-sm-and-down">
      <v-divider vertical></v-divider>
            <v-btn v-for="(category, index) in categories" :key="index" class="nav-item">
                <router-link :to="category.route" class="nav-link">  {{ category.name   }} </router-link>
            </v-btn>
    </v-toolbar-items>


</template>

<script>
export default {
    data() {
        return {
            categories: [
                {
                    name: "Inicio",
                    route: "/"
                },
                {
                    name: "Matriculas",
                    route: "/matriculas"
                },
                {
                    name: "Padres",
                    route: "/padres"
                },
                {
                    name: "Alumnos",
                    route: "/alumnos"
                },
                {
                    name: "Pagos",
                    route: "/pagos"
                },
                {
                    name: "Profesores",
                    route: "/profesores"
                },
                {
                    name: "Grupos",
                    route: "/grupos"
                }
            ]
        };
    }
};
</script>
<style lang="css"></style>
