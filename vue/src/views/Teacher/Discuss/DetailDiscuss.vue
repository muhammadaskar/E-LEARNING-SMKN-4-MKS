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
          </div>
          <!--/ Discuss Fields -->

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
              Simpan
            </button>
          </div>
        </div>
      </form>

      <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        <label for="discuss" class="block text-sm font-medium text-gray-700"
          >Komentar</label
        >
        <div v-if="comments.loading" class="justify-center">
          <div
            class="
              border border-white-300
              shadow
              rounded-md
              p-6
              w-full
              mx-auto
              mb-2
            "
            v-for="n in 3"
            :key="n"
          >
            <div class="animate-pulse flex space-x-4">
              <div class="flex-1 space-y-6 py-1">
                <div class="h-2 bg-slate-700 rounded"></div>
                <div class="h-2 bg-slate-700 rounded"></div>
              </div>
            </div>
          </div>
        </div>
        <div
          v-else
          class="flex flex-row mb-2"
          v-for="assignment in comments.data"
          :key="assignment.id"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-12 w-12"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>
          <div class="basis-5/6 pl-4">
            <h1>{{ assignment.comment }}</h1>
            <p class="">{{ assignment.created_at }}</p>
          </div>
          <div class="pt-3"></div>
          <div class="pt-3 pl-2" v-if="assignment.user_id == model.user_id">
            <button
              v-if="assignment.id"
              @click="deleteAssignment(assignment.id)"
              type="button"
              class="
                inline-flex
                justify-center
                px-4
                border border-transparent
                shadow-sm
                text-sm
                font-medium
                rounded-md
                text-white
                bg-red-600
                hover:bg-red-700
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-red-500
              "
            >
              hapus
            </button>
          </div>
        </div>
      </div>
      <form
        class="animate-fade-in-down row-span-3 mt-4"
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
                >Tambah Komentar</label
              >
              <textarea
                id="discuss"
                name="discuss"
                rows="3"
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
          </div>
          <!--/ Discuss Fields -->

          <div class="px-4 py-3 text-right sm:px-6">
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

const router = useRouter();

const route = useRoute();

// const assignments = computed(() => store.state.discusses);
// store.dispatch("getTeacherDiscuss");

let model = ref({
  topic: "",
  user_id: "",
});

const comments = computed(() => store.state.currentComment);

watch(
  () => store.state.currentDiscuss.data,
  (newVal) => {
    model.value = {
      ...JSON.parse(JSON.stringify(newVal)),
      status: newVal.status !== "draft",
    };
  },
  () => store.state.currentComment.data,
  (newVal) => {
    model.value = {
      ...JSON.parse(JSON.stringify(newVal)),
      status: newVal.status !== "draft",
    };
  }
);

watch();

if (route.params.id) {
  store.dispatch("getTeacherDiscuss", route.params.id);
}

let errors = ref("");

function saveDiscuss() {
  console.log(model.value.due_date);
  store
    .dispatch("saveTeacherAssignment", model.value)
    .then(({ data }) => {
      store.commit("notify", {
        type: "success",
        message: "tugas berhasil disimpan ",
      });
      router.push({
        name: "TeacherAssignment",
      });
    })
    .catch((error) => {
      console.error(error.response.status);
      if (error.response.status === 422) {
        errors.value = error.response.data.errors;
      }
    });
}
</script>

<style>
</style>