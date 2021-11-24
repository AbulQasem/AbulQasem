<template>
    <div>
        <nav-bar></nav-bar>

        <v-card width="250px" class="card">
            <v-card-text>{{ "Pagado: " + total }}</v-card-text>
            <v-divider></v-divider>
            <v-card-text>{{ "A recaudar: " + matriculas }}</v-card-text>
            <v-divider></v-divider>

            <v-progress-circular
                class="progress-class"
                :rotate="-90"
                :size="120"
                :width="18"
                :value="value"
                color="pink"
            >
                {{ Math.trunc(value) + " %" }}
            </v-progress-circular>
        </v-card>
    </div>
</template>

<script>
import NavBar from "../NavBar.vue";
export default {
    components: {
        NavBar,
    },
    name: "home",
    data() {
        return {
            data: {
                padres: [],
            },
            total: 0,
            matriculas: 0,
            value: 0,
        };
    },
    methods: {
        getPadres() {
            axios.get("api/padres").then((response) => {
                this.data.padres = response.data.data.padres;

                console.log(this.data.padres.length);
                let pagado;

                for (var i = 0; i < this.data.padres.length; i += 1) {
                    pagado = this.data.padres[i].pagado;

                    if (pagado != null) {
                        this.total = this.total + pagado;
                        this.matriculas =
                            this.matriculas + this.data.padres[i].Matricula;
                    }
                }

                this.value = (this.total / this.matriculas) * 100;
                console.log(this.total);
                console.log(this.matriculas);
            });
        },
    },
    mounted() {
        this.getPadres();
    },
};
</script>

<style>
.progress-class {
    width: auto ;
    padding: 15px;
    justify-content: center;
}

.card {
    margin: 10px 10px;
}
</style>
