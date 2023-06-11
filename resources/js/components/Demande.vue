<template>
    <div class="dcWrapper">
        <div>Demande</div>

        <div class="dC">
            <div class="hrSelect">
                <div>Select HR:</div>
                <select v-model="selectedRh" name="" id="">
                    <option v-for="i in rh" :value="i">{{ i.name }}</option>
                </select>
            </div>
            <div class="data">
                <div class="div">
                    <div class="formT">Upload CV</div>
                    <div class="fileUpload">
                        <div>Drag files here or click to upload...</div>
                    </div>
                </div>
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
            </div>
            <div class="errors">
                <div v-for="error in errors">
                    <div v-for="err in error" class="error">{{ err }}</div>
                </div>
            </div>
        </div>
        <div class="flexx"><div @click="submit()" class="loginButton submitBtn">submit</div></div>
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

<style>
.submitBtn {
    width: fit-content;
    margin: auto 8px;
}
.dcWrapper {
    /* display: grid;
    justify-content: center; */
}
.data {
    display: flex;
    justify-content: space-around;
    align-items: center;
    width: 100%;
}
.data .div{
    height: 100%;
    margin-bottom: 12px;

}
.flexx{
    justify-content: center;
    align-items: center;
    display: flex;
}
.dC {
    width: 100%;
}
.fileUpload {
    background: rgba(255, 255, 255, 0.151);
    color: gray;
    border-radius: 4px;
    border: solid 0.6px gray;
    height: 250px;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 250px;
}
.fileUpload div {
    max-width: 80%;
}
.form {
    margin: unset !important;
    width: 60% !important;
}
.form textarea {
    width: 100%;
    background: rgba(255, 255, 255, 0.151);
    color: gray;
    border-radius: 4px;
    border: solid 0.6px gray;
    padding-inline: 4px;
    height: 250px;
}
.formT {
    margin-bottom: 12px;
}
.hrSelect {
    text-align: center;
    margin-bottom: 35px;
}
</style>
