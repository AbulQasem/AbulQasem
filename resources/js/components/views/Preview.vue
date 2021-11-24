<template>
    <div class="pdf">
        <v-card shaped elevation="2">
            <v-img
                src="https://cdn.vuetifyjs.com/images/parallax/material.jpg"
                max-height="100"
            ></v-img>

            <v-card-title class="justify-center">
                Escuela Abu Al-Qasem de Zaragoza
            </v-card-title>
        </v-card>

        <v-card shaped class="mt-5" elevation="1">
            <v-card-title class="justify-center">
                Datos personales
            </v-card-title>
            <v-divider></v-divider>

            <v-card-text>
                <!-- NOMBRE Y APELLIDO -->
                <v-list-item>
                    <v-list-item-icon>
                        <v-icon color="indigo" class="icon">
                            mdi-account
                        </v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title> Nombre </v-list-item-title>
                        <v-list-item-subtitle>{{
                            padre.name + " " + padre.surname
                        }}</v-list-item-subtitle>
                    </v-list-item-content>

                    <!-- DNI-->
                    <v-list-item-icon>
                        <v-icon color="indigo" class="icon"> mdi-card </v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title> DNI </v-list-item-title>
                        <v-list-item-subtitle>{{
                            padre.dni
                        }}</v-list-item-subtitle>
                    </v-list-item-content>
                    <!-- Phone -->
                    <v-list-item-icon>
                        <v-icon color="indigo" class="icon"> mdi-phone </v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title> Teléfono </v-list-item-title>
                        <v-list-item-subtitle>{{
                            padre.telefono
                        }}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>

                <!-- Mail-->
                <v-list-item>
                    <v-list-item-icon>
                        <v-icon color="indigo" class="icon"> mdi-mail </v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title> Correo </v-list-item-title>
                        <v-list-item-subtitle>{{
                            padre.email
                        }}</v-list-item-subtitle>
                    </v-list-item-content>

                    <!-- Address-->
                    <v-list-item-icon>
                        <v-icon color="indigo" class="icon">
                            mdi-map-marker
                        </v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title> Dirección </v-list-item-title>
                        <v-list-item-subtitle>
                            {{
                                padre.address +
                                ", " +
                                padre.postalcode +
                                ", " +
                                padre.city
                            }}
                        </v-list-item-subtitle>
                    </v-list-item-content>
                    <v-list-item-content> </v-list-item-content>
                </v-list-item>
            </v-card-text>
        </v-card>

        <v-card elevation="2" shaped class="mt-5">
            <v-card-title class="justify-center">
                Hijos matriculados
            </v-card-title>
            <v-divider></v-divider>

            <v-card-text>
                <v-list v-for="(hijo, index) in hijos" :key="index" three-line>
                    <!-- NOMBRE Y APELLIDO -->
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon color="indigo" class="icon">
                                mdi-account
                            </v-icon>
                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title> Nombre </v-list-item-title>
                            <v-list-item-subtitle>{{
                                hijo.name + " " + hijo.surname
                            }}</v-list-item-subtitle>
                        </v-list-item-content>

                        <v-list-item-content>
                            <v-list-item-title>
                                Fecha de nacimiento
                            </v-list-item-title>
                            <v-list-item-subtitle>{{
                                dateFormat(hijo.birthday)
                            }}</v-list-item-subtitle>
                        </v-list-item-content>

                        <v-list-item-content>
                            <v-list-item-title> Grupo </v-list-item-title>
                            <v-list-item-subtitle>{{
                                hijo.grupos_id
                            }}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-card-text>
        </v-card>

        <v-card shaped class="mt-5">
            <v-card-title class="justify-center">
                Pagos realizados
            </v-card-title>
            <v-divider></v-divider>

            <v-card-text>
                <v-list v-for="(pago, index) in pagos" :key="index">
                    <!-- PAGO -->
                    <v-list-item>
                        <v-list-item-content>
                            {{ "Fecha:   " + dateFormat(pago.created_at) }}
                        </v-list-item-content>
                        <v-list-item-content>
                            {{ "Cantidad:   " + pago.cantidad }}
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-card-text>
            <v-divider></v-divider>
        </v-card>
    </div>
</template>

<script>
export default {
    name: "padre",
    data() {
        return {
            dialog: false,
            print: false,
            tab: null,
            padre: {},
            hijos: [],
            pagos: [],
            nuevoPago: {
                padre_id: "",
                user_id: "",
                cantidad: "",
            },
        };
    },
    methods: {
        getPadre() {
            axios.get("/api/padres/2").then((response) => {
                this.padre = response.data.padre;
                this.hijos = response.data.hijos;
                this.pagos = response.data.pagos;
            });
        },
        dateFormat(isoDate) {
            const date = new Date(isoDate);

            return (
                date.getDate() +
                "-" +
                (date.getMonth() + 1) +
                "-" +
                date.getFullYear()
            );
        },
    },
    created() {
        this.getPadre();
    },
};
</script>

<style>
.pdf {
    margin: 10px;
    padding: 10px;
}
</style>
