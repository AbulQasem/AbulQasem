<template>
    <div>
        <nav-bar></nav-bar>

        <v-card>
            <v-toolbar flat color="primary" dark>
                <v-toolbar-title>User Profile</v-toolbar-title>
            </v-toolbar>
            <v-tabs vertical>
                <v-tab>
                    <v-icon left>
                        mdi-account
                    </v-icon>
                    Datos padre
                </v-tab>
                <v-tab>
                    <v-icon left>
                        mdi-lock
                    </v-icon>
                    Datos hijos
                </v-tab>
                <v-tab>
                    <v-icon left>
                        mdi-access-point
                    </v-icon>
                    Pagos realizados
                </v-tab>

                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            {{ padre.name }}
                        </v-card-text>
                    </v-card>
                </v-tab-item>

                <v-tab-item>
                    <v-card flat>
                        <v-card-text> Hola </v-card-text>
                    </v-card>
                </v-tab-item>

                <v-tab-item>
                    <v-card flat>
                        <v-card-text> Cara cola</v-card-text>
                    </v-card>
                </v-tab-item>
            </v-tabs>
        </v-card>
    </div>
</template>

<script>
import NavBar from "./NavBar.vue";

export default {
    name: "padre",
    components: { NavBar },
    props: ["padre_id"],

    data() {
        return {
            tab: null,

            padre: {},
            hijos: [],
            pagos: []
        };
    },
    methods: {
        getPadre() {
            axios.get("/api/padres/" + this.$route.params.id).then(response => {
                this.padre = response.data.padre;
                this.hijos = response.data.hijos;
                this.pagos = response.data.pagos;
            });
        }
    },
    created() {
        this.getPadre();
    }
};
</script>
