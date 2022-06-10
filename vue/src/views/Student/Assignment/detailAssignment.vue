<template>
  <div>
    <PageComponent>
      <template v-slot:header>
        <div class="flex justify-between items-center">
          <h1 class="text-3x1 font-bold text-gray-900">
            <router-link :to="{ name: 'StudentAssignments' }">
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

      <div
        v-if="loading"
        class="justify-center shadow sm:rounded-md sm:overflow-hidden"
      >
        <div class="p-6 w-full mx-auto">
          <div
            class="mb-2 animate-pulse flex space-x-4"
            v-for="n in 7"
            :key="n"
          >
            <div class="flex-1 space-y-4 py-1">
              <div class="h-2 bg-slate-700 rounded"></div>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="shadow sm:rounded-md sm:overflow-hidden">
        <!-- Tugas Fields -->
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
          <!-- TITLE -->
          <div>
            <h1 class="text-2xl font-medium">
              {{ model.title }}
            </h1>
          </div>
          <!--/ TITLE -->

          <!-- DESKRIPSI -->
          <div>
            <label
              for="description"
              class="block text-sm font-medium text-gray-700"
              >Deskripsi</label
            >
            <textarea
              disabled
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
          <!--/ DESKRIPSI -->

          <!-- DUE DATE -->
          <div>
            <label
              for="description"
              class="block text-sm font-medium text-gray-700"
              >Tenggang waktu</label
            >
            <Datepicker
              disabled
              v-model="model.due_date"
              :minDate="new Date()"
            ></Datepicker>
          </div>
          <!--/ DUE DATE -->
        </div>
        <!--/ Tugas Fields -->

        <hr />

        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
          <form
            class="animate-fade-in-down row-span-3"
            @submit.prevent="saveAssignment"
            enctype="multipart/form-data"
          >
            <label class="block text-sm font-medium text-gray-700">
              Tugas Anda
            </label>

            <label
              v-if="model.status_pengerjaan == 'belum_dikumpulkan'"
              class="block text-sm mt-2 font-medium text-yellow-700"
            >
              belum dikumpulkan
            </label>
            <label
              v-if="model.status_pengerjaan == 'telat'"
              class="block text-sm mt-2 font-medium text-red-700"
            >
              telat dikumpulkan
            </label>
            <label
              v-if="model.status_pengerjaan == 'tepat_waktu'"
              class="block text-sm mt-2 font-medium text-green-700"
            >
              sudah dikumpulkan
            </label>
            <!-- FIle -->
            <div>
              <label class="block text-sm mt-4 font-medium text-gray-700">
                File
              </label>
              <div class="mt-1 flex items-center">
                <svg
                  v-if="model.file"
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-6 w-6"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5 13l4 4L19 7"
                  />
                </svg>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="
                    flex
                    items-center
                    justify-center
                    h-12
                    w-12
                    rounded-full
                    overflow-hidden
                    bg-gray-100
                  "
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                  />
                </svg>
                <button
                  type="button"
                  class="
                    relative
                    overflow-hidden
                    ml-5
                    bg-white
                    py-2
                    px-3
                    border border-gray-300
                    rounded-md
                    shadow-sm
                    text-sm
                    leading-4
                    font-medium
                    text-gray-700
                    hover:bg-gray-50
                    focus:outline-none
                    focus:ring-2
                    focus:ring-offset-2
                    focus:ring-indigo-500
                  "
                >
                  <input
                    type="file"
                    @change="onChange"
                    class="
                      absolute
                      left-0
                      top-0
                      right-0
                      bottom-0
                      opacity-0
                      cursor-pointer
                    "
                  />
                  ganti
                </button>
              </div>
            </div>

            <!-- FIle -->

            <div class="pr-5 pt-5 text-left sm:px-6">
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
                Kirim
              </button>
            </div>
          </form>
        </div>
      </div>
    </PageComponent>
  </div>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import PageComponent from "../../../components/PageComponent.vue";
import { useRoute, useRouter } from "vue-router";
import store from "../../../store";

import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

const router = useRouter();

const route = useRoute();

let model = ref({
  assignment_id: "",
  student_assignment_id: "",
  title: "",
  description: "",
  due_date: "",
  file: null,
  status_pengerjaan: "",
});

watch(
  () => store.state.currentAssignment.data,
  (newVal) => {
    model.value = {
      ...JSON.parse(JSON.stringify(newVal)),
      status: newVal.status !== "draft",
    };
  }
);

const loading = store.state.currentAssignment.loading;

if (route.params.id) {
  store.dispatch("getStudentAssignment", route.params.id);
}

function onChange(e) {
  const file = e.target.files[0];
  model.value.file = file;
  console.log(model.value.file);
}

function saveAssignment() {
  let fd = new FormData();
  fd.append("assignment_id", model.value.assignment_id);
  fd.append("student_assignment_id", model.value.student_assignment_id);
  fd.append("file", model.value.file);

  //   if (model.value.student_assignment_id != null) {
  //     console.log("put");
  //     store.dispatch("editStudentAssignment", fd).then(() => {
  //       store.commit("notify", {
  //         type: "success",
  //         message: "tugas berhasil disimpan ",
  //       });
  //       store.dispatch("getStudentAssignment", route.params.id);
  //     });
  //   } else {
  //   console.log("post");
  store.dispatch("sendStudentAssignment", fd).then(() => {
    store.commit("notify", {
      type: "success",
      message: "tugas berhasil disimpan ",
    });
    store.dispatch("getStudentAssignment", route.params.id);
  });
  //   }
}
</script>

<style>
</style>