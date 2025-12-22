import { computed, isRef } from 'vue';

export function useMonthlyPayment(listingPrice, interestRate, durationYears) {
    const monthlyPayment = computed(() => {
        const principal = isRef(listingPrice) ? listingPrice.value : listingPrice;
        const monthlyRate = (isRef(interestRate) ? interestRate.value : interestRate) / 100 / 12;
        const numberOfPayments = isRef(durationYears) ? durationYears.value * 12 : durationYears * 12;
        return (principal * monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) / (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
    });

    const totalPaid = computed(() => {
        return monthlyPayment.value * (isRef(durationYears) ? durationYears.value * 12 : durationYears * 12);
    });

    const totalInterest = computed(() => {
        const principal = isRef(listingPrice) ? listingPrice.value : listingPrice;
        return totalPaid.value - principal;
    });

    return { monthlyPayment, totalPaid, totalInterest };
};