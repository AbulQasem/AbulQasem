<template>
    <div>
        <nav-bar></nav-bar>

        <v-card class="mx-auto mt-5" width="90%">
            <v-card-title class="arabic-text">
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
                class="arabic-text"
                :search="search"
                striped
            ></v-data-table>

            <v-btn color="warning" class="m-2" dark @click="generateReport()">
                Imprimir lista
            </v-btn>
        </v-card>
    </div>
</template>

<script>
import NavBar from "./NavBar.vue";
import VueHtml2pdf from "vue-html2pdf";

export default {
    components: { NavBar, VueHtml2pdf },
    name: "profesores",
    data() {
        return {
            search: "",
            alumnos: [],
            profesor: {},
            grupo: {},
            headers: [
                { text: "ID", value: "id" },
                { text: "Nombre", value: "name" },
                { text: "Apellido", value: "surname" },
                { text: "الإسم", value: "name_ar" },
                { text: "اللقب", value: "surname_ar" },
                { text: "Fecha de Nacimiento", value: "birthday" },
                { text: "Teléfono de contacto", value: "telefono" }
            ]
        };
    },
    methods: {
        getAlumnosGrupo() {
            axios.get("/api/grupos/" + this.$route.params.id).then(response => {
                this.alumnos = response.data.alumnos;
                this.profesor = response.data.profesor[0];
                this.grupo = response.data.grupo;
            });
        },
        generateReport() {
            this.$refs.html2Pdf.generatePdf();
        }
    },
    created() {
        this.getAlumnosGrupo();
    }
};
</script>

<style scoped></style>
