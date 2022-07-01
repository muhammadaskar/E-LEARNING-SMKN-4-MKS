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
      <div>
        <form
          class="animate-fade-in-down row-span-3"
          enctype="multipart/form-data"
        >
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
                  disabled
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
          </div>
        </form>
      </div>

      <h1 class="mt-3">Tugas Siswa</h1>

      <div v-if="loadingStudentAssignments" class="justify-center">
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
        >
          <div class="animate-pulse flex space-x-4">
            <div class="flex-1 space-y-6 py-1">
              <div class="h-2 bg-slate-700 rounded"></div>
              <div class="h-2 bg-slate-700 rounded"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- List Assignment -->
      <div v-else class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        <div class="flex flex-row">
          <div class="">
            <img
              class="h-8 w-8 mt-2 rounded-full"
              :src="'https://www.kindpng.com/picc/m/78-785827_user-profile-avatar-login-account-male-user-icon.png'"
              alt=""
            />
          </div>
          <div class="basis-5/6 pl-4">
            <h1>{{ model.name }}</h1>
            <div class="">{{ model.created_at }}</div>
            <label
              v-if="model.status_pengerjaan == 'belum_dikumpulkan'"
              class="block text-sm mt-2 font-medium text-yellow-700"
            >
              belum mengumpulkan
            </label>
            <label
              v-if="model.status_pengerjaan == 'telat'"
              class="block text-sm mt-2 font-medium text-red-700"
            >
              telat mengumpulkan
            </label>
            <label
              v-if="model.status_pengerjaan == 'tepat_waktu'"
              class="block text-sm mt-2 font-medium text-green-700"
            >
              sudah mengumpulkan
            </label>
            <!-- FIle -->
            <div v-if="model.status_pengerjaan != 'belum_dikumpulkan'">
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
                  @click.prevent="downloadFile(model.file)"
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
                  download
                </button>
              </div>
            </div>
            <!-- FIle -->
          </div>
        </div>
      </div>
      <!-- End List Assignment -->

      <h1 class="mt-3">Nilai Siswa</h1>
      <div v-if="loadingStudentAssignments" class="justify-center">
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
        >
          <div class="animate-pulse flex space-x-4">
            <div class="flex-1 space-y-6 py-1">
              <div class="h-2 bg-slate-700 rounded"></div>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        <div
          v-if="model.status_pengerjaan != 'belum_dikumpulkan'"
          class="flex flex-row"
        >
          <form
            @submit.prevent="saveStudentScore"
            class="animate-fade-in-down row-span-3"
          >
            <!-- Tugas Fields -->
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <!-- TITLE -->
              <div>
                <input
                  type="number"
                  name="nilai"
                  id="nilai"
                  autocomplete="nilai"
                  v-model="model.nilai"
                  class="
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
              <div class="grid grid-cols-2 gap-2">
                <div class="px-1 py-1 text-right sm:px-6">
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
                    simpan
                  </button>
                </div>
                <div
                  v-if="model.nilai != 0"
                  class="px-1 py-1 text-right sm:px-6"
                >
                  <button
                    @click="deleteScore(model.id)"
                    type="button"
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
            <!--/ TITLE -->
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

import Swal from "sweetalert2";

const router = useRouter();

const route = useRoute();

let model = ref({
  title: "",
  description: "",
  due_date: "",
  id: "",
  assignment_id: "",
  name: "",
  foto: null,
  status_pengerjaan: "",
  nilai: "",
  file: null,
  created_at: null,
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

const loadingStudentAssignments = computed(
  () => store.state.student_assignments.loading
);

if (route.params.id) {
  store.dispatch("teacherAssignmentResult", route.params.id);
}

function downloadFile(url) {
  console.log(url);
  window.open(url);
}
function saveStudentScore() {
  if (model.value.nilai > 0 && model.value.nilai <= 100) {
    store
      .dispatch("saveStudentScore", model.value)
      .then(({ data }) => {
        store.commit("notify", {
          type: "success",
          message: "nilai tugas siswa berhasil disimpan",
        });
        store.dispatch("teacherAssignmentResult", route.params.id);
      })
      .catch((error) => {
        console.log(error);
      });
  } else {
    store.commit("notify", {
      type: "failed",
      message: "nilai gagal disimpan",
    });
  }
}

function deleteScore(id) {
  Swal.fire({
    title: "",
    text: "Apakah anda yakin ingin menghapus?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ok",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      store.dispatch("deleteScore", id).then(() => {
        store.commit("notify", {
          type: "success",
          message: "nilai berhasil dihapus ",
        });
        store.dispatch("teacherAssignmentResult", route.params.id);
      });
    }
  });
}
</script>


<style>
</style>