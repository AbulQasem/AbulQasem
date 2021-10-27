<template>
    <v-dialog
        transition="dialog-bottom-transition"
        v-model="activate"
        max-width="800px"
        persistent
    >
        <v-card>
            <v-card-title class="text-h5">Nuevo grupo</v-card-title>
            <v-container>
                <v-row>
                    <v-col cols="6" sm="6">
                        <v-select
                            v-model="grupo.profesores_id"
                            id="docente"
                            label="Profesor"
                            :items="profesores"
                            item-text="name"
                            item-value="id"
                        >
                        </v-select>
                    </v-col>
                    <v-col cols="6" sm="6">
                        <v-select
                            :items="days"
                            label="Dia de la semana"
                            placeholder="Dia de la semana"
                            required
                            v-model="grupo.dia"
                        ></v-select>
                    </v-col>

                    <v-col cols="6" sm="4">
                        <v-select
                            :items="times"
                            label="Horario"
                            placeholder="Horario"
                            required
                            v-model="grupo.horario"
                        ></v-select>
                    </v-col>
                    <v-col cols="6" sm="4">
                        <v-select
                            :items="levels"
                            label="Nivel"
                            placeholder="Nivel"
                            required
                            v-model="grupo.nivel"
                        ></v-select>
                    </v-col>
                    <v-col cols="4" sm="4">
                        <v-select
                            :items="aula"
                            label="Aula"
                            placeholder="Aula"
                            required
                            v-model="grupo.aula"
                        ></v-select>
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close"
                    >Cancelar</v-btn
                >
                <v-btn color="blue darken-1" text @click="save">Guardar</v-btn>
                <v-spacer></v-spacer>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    components: {},
    name: "group-form",
    props: {
        activate: Boolean
    },
    data() {
        return {
            days: [
                "LUNES",
                "MARTES",
                "MIÉRCOLES",
                "JUEVES",
                "VIERNES",
                "SÁBADO",
                "DOMINGO"
            ],
            times: ["11:00-13:15", "16:00-18:15", "17:00-19:15"],
            profesores: [],
            profesorSeleccionado: "",
            levels: ["0", "1", "2", "3"],
            aula: ["1", "2", "3", "4", "5"],
            grupo: {
                profesores_id: "",
                horario: "",
                dia: "",
                aula: "",
                nivel: ""
            }
        };
    },
    methods: {
        getProfesores() {
            axios.get("api/profesores").then(response => {
                this.profesores = response.data.data;
            });
        },
        save() {
            this.submitForm();
        },
        submitForm() {
            axios
                .post("api/grupos/", this.grupo)
                .then(response => {
                    if (response.status === 200) {
                        this.close();
                    }
                })
                .catch(error => {
                    console.log(this.grupo);
                })
                .finally(() => {
                    //Perform action in always
                });
        },
        close() {
            this.$emit("close-form-event", false);
        }
    },
    created() {
        this.getProfesores();
    }
};
</script>
