<template>
  <div>
    <PageComponent>
      <template v-slot:header>
        <div class="flex justify-between items-center">
          <h1 class="text-3x1 font-bold text-gray-900">
            <router-link :to="{ name: 'TeacherAssignment' }">
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
            Tugas
          </h1>
        </div>
      </template>
      <div class="grid grid-cols-2 gap-2">
        <div class="mt-12">
          <img
            src="https://img.freepik.com/free-vector/teacher-character-collection_23-2148517110.jpg?w=2000"
          />
        </div>
        <form
          class="animate-fade-in-down row-span-3"
          @submit.prevent="saveAssignment"
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
            <!-- Tugas Fields -->
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <!-- TITLE -->
              <div>
                <label
                  for="title"
                  class="block text-sm font-medium text-gray-700"
                  >Judul tugas</label
                >
                <input
                  type="text"
                  name="title"
                  id="title"
                  autocomplete="title"
                  v-model="model.title"
                  class="
                    mt-1
                    focus:ring-indigo-500 focus:border-indigo-500
                    block
                    w-full
                    shadow-sm
                    sm:text-sm
                    border-gray-300
                    rounded-md
                  "
                />
              </div>
              <!--/ TITLE -->

              <!-- DESKRISPI -->
              <div>
                <label
                  for="description"
                  class="block text-sm font-medium text-gray-700"
                  >Deskripsi</label
                >
                <textarea
                  id="description"
                  name="description"
                  rows="3"
                  v-model="model.description"
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
              <!--/ DESKRISPI -->

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
            <!--/ Tugas Fields -->

            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
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
                  v-if="loading"
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
      </div>
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

const router = useRouter();

const route = useRoute();

let loading = ref(false);

let model = ref({
  title: "",
  description: "",
  due_date: "",
});

let errors = ref("");

function saveAssignment() {
  loading.value = true;
  console.log(model.value.due_date);
  store
    .dispatch("saveTeacherAssignment", model.value)
    .then(({ data }) => {
      loading.value = false;
      store.commit("notify", {
        type: "success",
        message: "tugas berhasil disimpan ",
      });
      router.push({
        name: "TeacherAssignment",
      });
    })
    .catch((error) => {
      loading.value = false;
      console.error(error.response.status);
      if (error.response.status === 422) {
        errors.value = error.response.data.errors;
      }
    });
}
</script>

<style>
</style>