import { getInstruments, getPrice } from '../Service/device-service.js';

const tableSelect = document.querySelector<HTMLSelectElement>('#table_name');
const categorySelect = document.querySelector<HTMLSelectElement>('#category_name');
const instrumentSelect = document.querySelector<HTMLSelectElement>('#category_data');
const priceInput = document.querySelector<HTMLInputElement>('#category_Price');
const statusMessage = document.querySelector<HTMLElement>('#form-status');

function showError(error: unknown): void {
    if (statusMessage === null) {
        return;
    }

    statusMessage.textContent = error instanceof Error
        ? error.message
        : 'The request could not be completed.';
    statusMessage.hidden = false;
}

async function updatePrice(): Promise<void> {
    if (
        tableSelect === null ||
        instrumentSelect === null ||
        priceInput === null ||
        statusMessage === null
    ) {
        return;
    }

    statusMessage.hidden = true;
    try {
        const result = await getPrice(tableSelect.value, instrumentSelect.value);
        priceInput.value = result.price;
    } catch (error: unknown) {
        showError(error);
    }
}

async function updateInstruments(): Promise<void> {
    if (
        tableSelect === null ||
        categorySelect === null ||
        instrumentSelect === null ||
        priceInput === null ||
        statusMessage === null
    ) {
        return;
    }

    statusMessage.hidden = true;
    priceInput.value = '';
    try {
        const instruments = await getInstruments(tableSelect.value, categorySelect.value);
        instrumentSelect.replaceChildren();
        instruments.forEach((instrument: string) => {
            const option = document.createElement('option');
            option.value = instrument;
            option.textContent = instrument;
            instrumentSelect.append(option);
        });

        if (instruments.length > 0) {
            await updatePrice();
        }
    } catch (error: unknown) {
        showError(error);
    }
}

tableSelect?.addEventListener('change', updateInstruments);
categorySelect?.addEventListener('change', updateInstruments);
instrumentSelect?.addEventListener('change', updatePrice);

if (
    tableSelect !== null &&
    categorySelect !== null &&
    instrumentSelect !== null &&
    priceInput !== null &&
    statusMessage !== null
) {
    void updateInstruments();
}
