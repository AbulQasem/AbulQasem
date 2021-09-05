<template>
    <div>
        <nav-bar></nav-bar>

        <v-card>
            <v-card-title>
                {{ "Grupo: " + grupo.dia + " " + grupo.horario }}
                {{ "Nivel:  " + grupo.nivel }}
                {{ "Profesor:  " + profesor.name + " " + profesor.surname }}
                <v-spacer></v-spacer>

                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>

            <v-data-table
                dense
                :headers="headers"
                :items="alumnos"
                :items-per-page="15"
                item-key="id"
                class="elevation-1"
                :search="search"
            ></v-data-table>
        </v-card>
    </div>
</template>

<script>
import NavBar from "./NavBar.vue";
export default {
    components: { NavBar },
    name: "profesores",
    data() {
        return {
            search: "",
            alumnos: [],
            profesor: {},
            grupo: {},
            headers: [
                { text: "Nombre", value: "name" },
                { text: "Apellido", value: "surname" },
                { text: "الإسم", value: "name_ar" },
                { text: "اللقب", value: "surname_ar" }
            ]
        };
    },
    methods: {
        getAlumnosGrupo() {
            console.log("/api/grupos/" + this.$route.params.id);
            axios.get("/api/grupos/" + this.$route.params.id).then(response => {

                this.alumnos = response.data.alumnos;
                this.profesor = response.data.profesor[0];
                this.grupo = response.data.grupo;

                console.log(this.profesor);
            });
        }
    },
    created() {
        this.getAlumnosGrupo();
    }
};
</script>

<style scoped></style>
