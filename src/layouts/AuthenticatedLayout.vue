<script setup>
import { ref, onBeforeMount } from 'vue';
import { useUsers } from '@/stores/user';
import ApplicationLogo from '@/components/ApplicationLogo.vue';
import Dropdown from '@/components/Dropdown.vue';
import DropdownLink from '@/components/DropdownLink.vue';
import NavLink from '@/components/NavLink.vue';
import ResponsiveNavLink from '@/components/ResponsiveNavLink.vue';
import { useCart } from '@/stores/cart';

const showingNavigationDropdown = ref(false);

const userStore = useUsers();
const cartStore = useCart();

const auth = userStore.authUser;

onBeforeMount(() => {
  if (!userStore.hasUserData) {
    userStore.getData();
  }
  cartStore.getData();
});

const submitLogout = () => {
  userStore.logout();
};
</script>

<template>
  <div v-if="auth">
    <div class="min-h-screen bg-gray-100">
      <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex">
              <!-- Logo -->
              <div class="shrink-0 flex items-center">
                <router-link to="/">
                  <ApplicationLogo class="block h-9 w-auto"/>
                </router-link>
              </div>

              <!-- Navigation Links -->
              <div
                  class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <router-link
                    v-slot="{ href, isActive, navigate }"
                    to="/dashboard"
                    custom>
                  <NavLink
                      :href="href"
                      :active="isActive"
                      @click="navigate">
                    Dashboard
                  </NavLink>
                </router-link>
                <router-link
                    v-slot="{ href, isActive, navigate }"
                    to="/courses"
                    custom>
                  <NavLink
                      :href="href"
                      :active="isActive"
                      @click="navigate">
                    Courses
                  </NavLink>
                </router-link>
              </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
              <router-link
                  v-slot="{ href, isActive, navigate }"
                  to="/cart"
                  custom>
                <NavLink
                    :href="href"
                    :active="isActive"
                    @click="navigate">
                  <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                       xmlns:xlink="http://www.w3.org/1999/xlink"
                       width="16px" height="16px" viewBox="0 0 902.86 902.86"
                       xml:space="preserve">
<g>
	<g>
		<path d="M671.504,577.829l110.485-432.609H902.86v-68H729.174L703.128,179.2L0,178.697l74.753,399.129h596.751V577.829z
			 M685.766,247.188l-67.077,262.64H131.199L81.928,246.756L685.766,247.188z"/>
    <path d="M578.418,825.641c59.961,0,108.743-48.783,108.743-108.744s-48.782-108.742-108.743-108.742H168.717
			c-59.961,0-108.744,48.781-108.744,108.742s48.782,108.744,108.744,108.744c59.962,0,108.743-48.783,108.743-108.744
			c0-14.4-2.821-28.152-7.927-40.742h208.069c-5.107,12.59-7.928,26.342-7.928,40.742
			C469.675,776.858,518.457,825.641,578.418,825.641z M209.46,716.897c0,22.467-18.277,40.744-40.743,40.744
			c-22.466,0-40.744-18.277-40.744-40.744c0-22.465,18.277-40.742,40.744-40.742C191.183,676.155,209.46,694.432,209.46,716.897z
			 M619.162,716.897c0,22.467-18.277,40.744-40.743,40.744s-40.743-18.277-40.743-40.744c0-22.465,18.277-40.742,40.743-40.742
			S619.162,694.432,619.162,716.897z"/>
	</g>
</g>
</svg>
                  <span
                      class="ml-1 bg-green-400 text-white font-bold px-2 rounded-full">{{
                      cartStore.cartData.total_count ?? 0
                    }}</span>

                </NavLink>
              </router-link>
              <!-- Settings Dropdown -->
              <div class="ml-3 relative">
                <Dropdown align="right" width="48">
                  <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ userStore.userData.name }}
                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </span>
                  </template>

                  <template #content>
                    <DropdownLink @click="submitLogout">
                      Log Out
                    </DropdownLink>
                  </template>
                </Dropdown>
              </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
              <button
                  class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                  @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                ">
                <svg
                    class="h-6 w-6"
                    stroke="currentColor"
                    fill="none"
                    viewBox="0 0 24 24">
                  <path
                      :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
                  <path
                      :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
            :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
            class="sm:hidden">
          <div class="pt-2 pb-3 space-y-1">
            <router-link
                v-slot="{ href, isActive, navigate }"
                to="/dashboard"
                custom>
              <ResponsiveNavLink
                  :href="href"
                  :active="isActive"
                  @click="navigate">
                Dashboard
              </ResponsiveNavLink>
            </router-link>
          </div>

          <!-- Responsive Settings Options -->
          <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
              <div class="font-medium text-base text-gray-800">
                {{ userStore.userData.name }}
              </div>
              <div class="font-medium text-sm text-gray-500">
                {{ userStore.userData.email }}
              </div>
            </div>

            <div class="mt-3 space-y-1">
              <router-link
                  v-slot="{ href, navigate }"
                  to="/"
                  custom>
                <ResponsiveNavLink
                    :href="href"
                    @click="navigate">
                  Log Out
                </ResponsiveNavLink>
              </router-link>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header v-if="$slots.header" class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header"/>
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot/>
      </main>
    </div>
  </div>
</template>
