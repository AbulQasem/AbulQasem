<template>
    <div>
        <nav-bar></nav-bar>

        <v-card class="mx-auto mt-10" max-width="80%">
            <v-toolbar flat color="primary" dark>
                <v-toolbar-title>Ficha Profesor</v-toolbar-title>
            </v-toolbar>
            <v-tabs vertical>
                <v-tab>
                    <v-icon left>
                        mdi-account
                    </v-icon>
                    Datos
                </v-tab>

                <v-tab>
                    <v-icon left>
                        mdi-account-group 
                    </v-icon>
                    Grupos
                </v-tab>

                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <v-list>
                                <!-- NOMBRE Y APELLIDO -->
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon color="indigo">
                                            mdi-account
                                        </v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Nombre
                                        </v-list-item-title>
                                        <v-list-item-subtitle>{{
                                            profesor.name +
                                                " " +
                                                profesor.surname
                                        }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                                <!-- Phone -->
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon color="indigo">
                                            mdi-phone
                                        </v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Teléfono
                                            <v-btn
                                                class="mx-2 whatsapp-button"
                                                fab
                                                small
                                                color="green"
                                                outlined
                                                @click="goToWhatsApp"
                                            >
                                                <v-icon>
                                                    mdi-whatsapp
                                                </v-icon>
                                            </v-btn>
                                        </v-list-item-title>

                                        <v-list-item-subtitle>{{
                                            profesor.telefono
                                        }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                                <!-- DNI-->
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon color="indigo">
                                            mdi-card
                                        </v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        <v-list-item-title>
                                            DNI
                                        </v-list-item-title>
                                        <v-list-item-subtitle>{{
                                            profesor.dni
                                        }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                                <!-- Mail-->
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon color="indigo">
                                            mdi-mail
                                        </v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Correo
                                        </v-list-item-title>
                                        <v-list-item-subtitle>{{
                                            profesor.email
                                        }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                                <!-- Address-->
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon color="indigo">
                                            mdi-map-marker
                                        </v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Dirección
                                        </v-list-item-title>
                                        <v-list-item-subtitle>
                                            {{
                                                profesor.address +
                                                    ", " +
                                                    profesor.postalcode +
                                                    ", " +
                                                    profesor.city
                                            }}
                                        </v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list>
                        </v-card-text>
                    </v-card>
                </v-tab-item>

                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <v-list
                                v-for="(grupo, index) in grupos"
                                :key="index"
                            >
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon color="indigo">
                                            mdi-account-group 
                                        </v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        {{ "Nivel: " + grupo.nivel + " - " + grupo.dia + " - " + grupo.horario}}
                                    </v-list-item-content>
                                </v-list-item>
                                <v-divider></v-divider>
                            </v-list>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
            </v-tabs>
        </v-card>
    </div>
</template>

<script>
import NavBar from "./NavBar.vue";

export default {
    name: "profesor",
    components: { NavBar },
    data() {
        return {
            dialog: false,
            tab: null,
            profesor: {},
            grupos: []
        };
    },
    methods: {
        getProfesor() {
            axios
                .get("/api/profesores/" + this.$route.params.id)
                .then(response => {
                    this.profesor = response.data.profesor;
                    this.grupos = response.data.grupos;
                });
        },
        goToWhatsApp() {
            window.open(
                "https://api.whatsapp.com/send?phone=34" +
                    this.profesor.telefono +
                    "&attachment=C:/Users/Ahmad/DownloadfichaPadre.pdf"
            );
        }
    },
    created() {
        this.getProfesor();
    }
};
</script>

<style>
.whatsapp-button {
    margin: 2px;
    padding: 2px;
}

.buttons {
    padding: auto;
    margin: 10px;
}
</style>
