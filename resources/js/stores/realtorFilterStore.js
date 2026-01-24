import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

export const useRealtorFiltersStore = defineStore('realtorFilters', () => {
    // State
    const filters = ref({
        deleted: null,
        sortBy: null,
        sortStyle: null
    });

    // Getters
    // const hasFilters = computed(() => {
    //     return Object.values(filters.value).some(val => val !== null && val !== undefined);
    // });

    const filtersObject = computed(() => {
        // Chỉ trả về filters không null
        const result = {};
        Object.keys(filters.value).forEach(key => {
            if (filters.value[key] !== null && filters.value[key] !== undefined) {
                result[key] = filters.value[key];
            }
        });
        return result;
    });

    // Actions
    function setFilters(newFilters) {
        filters.value = {
            deleted: newFilters.deleted || null,
            sortBy: newFilters.sortBy || null,
            sortStyle: newFilters.sortStyle || null
        };

        // Persist vào sessionStorage
        saveToStorage();
    }

    // function updateFilter(key, value) {
    //     filters.value[key] = value;
    //     saveToStorage();
    // }

    // function clearFilters() {
    //     filters.value = {
    //         deleted: null,
    //         sortBy: null,
    //         sortStyle: null
    //     };
    //     sessionStorage.removeItem('realtor_filters');
    // }

    function saveToStorage() {
        try {
            sessionStorage.setItem('realtor_filters', JSON.stringify(filters.value));
        } catch (e) {
            console.error('Failed to save filters:', e);
        }
    }

    function loadFromStorage() {
        try {
            const stored = sessionStorage.getItem('realtor_filters');
            if (stored) {
                filters.value = JSON.parse(stored);
            }
        } catch (e) {
            console.error('Failed to load filters:', e);
        }
    }

    // Load từ storage khi khởi tạo
    loadFromStorage();

    return {
        // State
        filters,

        // Getters
        // hasFilters,
        filtersObject,

        // Actions
        setFilters,
        // updateFilter,
        // clearFilters,
        loadFromStorage
    };
},
    {
        // Options: persist state
        persist: false // Chúng ta tự handle với sessionStorage
    });