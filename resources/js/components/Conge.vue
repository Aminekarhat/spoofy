<template>
    <div v-if="!admin">
        <div>Select Date:</div>
        <div>
            <input v-model="date" type="date" />
        </div>
        <div class="errors">
            <div v-for="error in errors">
                <div v-for="err in error" class="error">{{ err }}</div>
            </div>
        </div>
        <div @click="submit()" class="loginButton">submit</div>
    </div>
    <div v-else></div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            admin: localStorage.getItem("admin") == "false" ? false : true,
            user: JSON.parse(localStorage.getItem("user")),
            date: "",
            errors: []
        };
    },
    methods: {
        submit() {
            axios
                .post("/user/off", { user: this.user, date: this.date })
                .then((res) => {
                    this.date = "";
                    this.errors = { x: ["sent."] };
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                });
        },
    },
};
</script>

<style></style>
