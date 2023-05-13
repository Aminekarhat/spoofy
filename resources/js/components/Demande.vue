<template>
    <div>
        <div>Demande</div>

        <div>
            <div>Select HR:</div>
            <select v-model="selectedRh" name="" id="">
                <option v-for="i in rh" :value="i">{{ i.name }}</option>
            </select>
            <div class="form">
                <div class="formG">
                    <div class="formT">Message</div>
                    <textarea
                        name=""
                        v-model="message"
                        id=""
                        cols="30"
                        rows="10"
                    ></textarea>
                </div>
            </div>
            <div class="errors">
                <div v-for="error in errors">
                    <div v-for="err in error" class="error">{{ err }}</div>
                </div>
            </div>
            <div @click="submit()" class="loginButton">submit</div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            rh: [],
            selectedRh: "",
            user: JSON.parse(localStorage.getItem("user")),
            admin: localStorage.getItem("admin") == "false" ? false : true,
            message: "kek",
            errors: [],
        };
    },
    created() {
        axios.get("/rh/all").then((res) => {
            this.rh = res.data;
            this.selectedRh = this.rh[0];
        });
    },
    methods: {
        submit() {
            console.log(this.selectedRh.name);
            axios
                .post("/user/application", {
                    user: this.user,
                    rh: this.selectedRh,
                    message: this.message,
                })
                .then((res) => {
                    this.message = "";
                    this.selectedRh = "";
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
