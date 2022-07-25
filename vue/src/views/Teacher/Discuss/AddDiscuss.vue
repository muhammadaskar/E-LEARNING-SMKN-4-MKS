<template>
  <div>
    <PageComponent>
      <template v-slot:header>
        <div class="flex justify-between items-center">
          <h1 class="text-3x1 font-bold text-gray-900">
            <router-link :to="{ name: 'TeacherDiscuss' }">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 inline-block"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  fill-rule="evenodd"
                  d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                  clip-rule="evenodd"
                /></svg
            ></router-link>
            Diskusi
          </h1>
        </div>
      </template>
      <form
        class="animate-fade-in-down row-span-3"
        @submit.prevent="saveDiscuss"
        enctype="multipart/form-data"
      >
        <Alert
          v-if="Object.keys(errors).length"
          class="flex-col items-stretch text-sm"
        >
          <div v-for="(field, i) of Object.keys(errors)" :key="i">
            <div v-for="(error, ind) of errors[field] || []" :key="ind">
              * {{ error }}
            </div>
          </div>
        </Alert>
        <div class="shadow sm:rounded-md sm:overflow-hidden">
          <!-- Discuss Fields -->
          <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <!-- TOPIK -->
            <div>
              <label
                for="discuss"
                class="block text-sm font-medium text-gray-700"
                >Topik</label
              >

              <textarea
                id="discuss"
                name="discuss"
                rows="3"
                v-model="model.topic"
                class="
                  shadow-sm
                  focus:ring-indigo-500 focus:border-indigo-500
                  mt-1
                  block
                  w-full
                  sm:text-sm
                  border border-gray-300
                  rounded-md
                "
              />
            </div>
            <!--/ TOPIK -->

            <!-- DUE DATE -->
            <div>
              <label
                for="description"
                class="block text-sm font-medium text-gray-700"
                >Tenggang waktu</label
              >
              <Datepicker
                v-model="model.due_date"
                :minDate="new Date()"
              ></Datepicker>
            </div>
            <!--/ DUE DATE -->
          </div>
          <!--/ Discuss Fields -->

          <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
            <button
              type="submit"
              class="
                inline-flex
                justify-center
                py-2
                px-4
                border border-transparent
                shadow-sm
                text-sm
                font-medium
                rounded-md
                text-white
                bg-indigo-600
                hover:bg-indigo-700
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-indigo-500
              "
            >
              <svg
                v-if="loadingDiscuss"
                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
              >
                <circle
                  class="opacity-25"
                  cx="12"
                  cy="12"
                  r="10"
                  stroke="currentColor"
                  stroke-width="4"
                ></circle>
                <path
                  class="opacity-75"
                  fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                ></path>
              </svg>
              Simpan
            </button>
          </div>
        </div>
      </form>
    </PageComponent>
  </div>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import PageComponent from "../../../components/PageComponent.vue";
import Alert from "../../../components/Alert.vue";
import { useRoute, useRouter } from "vue-router";
import store from "../../../store";

import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

import Swal from "sweetalert2";

const router = useRouter();

const route = useRoute();

let model = ref({
  topic: "",
  due_date: "",
});

let loadingDiscuss = ref(false);
let errors = ref("");

function saveDiscuss() {
  loadingDiscuss.value = true;
  if (model.value.topic == "") {
    loadingDiscuss.value = false;
    store.commit("notify", {
      type: "failed",
      message: "form diskusi wajib diisi",
    });
  } else {
    store
      .dispatch("saveTeacherDiscuss", model.value)
      .then(({ data }) => {
        loadingDiscuss.value = false;
        store.commit("notify", {
          type: "success",
          message: "topik diskusi berhasil disimpan ",
        });
        router.push({
          name: "TeacherDiscuss",
        });
      })
      .catch((error) => {
        loadingDiscuss.value = false;
        console.error(error.response.status);
        if (error.response.status === 422) {
          errors.value = error.response.data.errors;
        }
      });
  }
}
</script>

<style>
</style>