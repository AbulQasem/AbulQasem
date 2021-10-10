<template>
    <div>
        <vue-html2pdf
            :show-layout="false"
            :float-layout="true"
            :enable-download="true"
            :preview-modal="true"
            :paginate-elements-by-height="1400"
            filename="fichaPadre"
            :pdf-quality="2"
            :manual-pagination="false"
            pdf-format="a4"
            pdf-content-width="800px"
            ref="html2Pdf"
        >
            <section slot="pdf-content">
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
                                        padre.name + " " + padre.surname
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
                                    </v-list-item-title>
                                    <v-list-item-subtitle>{{
                                        padre.telefono
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
                                        padre.dni
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
                                        padre.email
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
                                            padre.address +
                                                ", " +
                                                padre.postalcode +
                                                ", " +
                                                padre.city
                                        }}
                                    </v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-card-text>
                </v-card>
            </section>
        </vue-html2pdf>
    </div>
</template>

<script>
import VueHtml2pdf from "vue-html2pdf";

export default {
    data() {
        return {
            padre: [],
            hijos: [],
            pagos: []
        };
    },
    methods: {
        /*
            Generate Report using refs and calling the
            refs function generatePdf()
        */
        generateReport() {
            this.$refs.html2Pdf.generatePdf();
        },
        getPadre() {
            axios.get("/api/padres/" + this.$route.params.id).then(response => {
                this.padre = response.data.padre;
                this.hijos = response.data.hijos;
                this.pagos = response.data.pagos;
            });
        }
    },
    components: {
        VueHtml2pdf
    },
    created() {
        this.getPadre();
    },
    mounted() {
        this.generateReport();
    }
};
</script>
