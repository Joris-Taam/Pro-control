import { getInstruments, getPrice } from '../Service/device-service.js';
const tableSelect = document.querySelector('#table_name');
const categorySelect = document.querySelector('#category_name');
const instrumentSelect = document.querySelector('#category_data');
const priceInput = document.querySelector('#category_Price');
const statusMessage = document.querySelector('#form-status');
function showError(error) {
    if (statusMessage === null) {
        return;
    }
    statusMessage.textContent = error instanceof Error
        ? error.message
        : 'The request could not be completed.';
    statusMessage.hidden = false;
}
async function updatePrice() {
    if (tableSelect === null ||
        instrumentSelect === null ||
        priceInput === null ||
        statusMessage === null) {
        return;
    }
    statusMessage.hidden = true;
    try {
        const result = await getPrice(tableSelect.value, instrumentSelect.value);
        priceInput.value = result.price;
    }
    catch (error) {
        showError(error);
    }
}
async function updateInstruments() {
    if (tableSelect === null ||
        categorySelect === null ||
        instrumentSelect === null ||
        priceInput === null ||
        statusMessage === null) {
        return;
    }
    statusMessage.hidden = true;
    priceInput.value = '';
    try {
        const instruments = await getInstruments(tableSelect.value, categorySelect.value);
        instrumentSelect.replaceChildren();
        instruments.forEach((instrument) => {
            const option = document.createElement('option');
            option.value = instrument;
            option.textContent = instrument;
            instrumentSelect.append(option);
        });
        if (instruments.length > 0) {
            await updatePrice();
        }
    }
    catch (error) {
        showError(error);
    }
}
tableSelect?.addEventListener('change', updateInstruments);
categorySelect?.addEventListener('change', updateInstruments);
instrumentSelect?.addEventListener('change', updatePrice);
if (tableSelect !== null &&
    categorySelect !== null &&
    instrumentSelect !== null &&
    priceInput !== null &&
    statusMessage !== null) {
    void updateInstruments();
}
