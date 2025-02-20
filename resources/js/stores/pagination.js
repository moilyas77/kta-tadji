import { defineStore } from "pinia";

export const usePaginationStore = defineStore("pagination", {
    state: () => ({
        currentPage: null,
        searchKey: ''
    }),
    getters: {
        getCurrentPage: (state) => state.currentPage,
        getSearchKey: (state) => state.searchKey,
    },
    actions: {
        setCurrentPage(currentPage){
          this.currentPage = currentPage;
        },
        setSearchKey(searchKey){
            this.searchKey = searchKey;
          },
    },
});
