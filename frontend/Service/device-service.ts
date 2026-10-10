interface InstrumentPriceResponse {
    price: string;
}

const endpoints = {
    categories: './get_category_data.php',
    price: './get_category_price.php',
} as const;

async function requestJson(url: string): Promise<unknown> {
    const response = await fetch(url, {
        headers: { Accept: 'application/json' },
    });
    const payload: unknown = await response.json();

    if (!response.ok) {
        const errorMessage =
            typeof payload === 'object' &&
            payload !== null &&
            'error' in payload &&
            typeof payload.error === 'string'
                ? payload.error
                : 'The request could not be completed.';
        throw new Error(errorMessage);
    }

    return payload;
}

export async function getInstruments(table: string, category: string): Promise<string[]> {
    const query = new URLSearchParams({ table, category });
    const payload = await requestJson(`${endpoints.categories}?${query}`);
    if (!Array.isArray(payload) || !payload.every((instrument) => typeof instrument === 'string')) {
        throw new Error('The server returned an invalid instrument list.');
    }

    return payload;
}

export async function getPrice(table: string, instrument: string): Promise<InstrumentPriceResponse> {
    const query = new URLSearchParams({ table, category: instrument });
    const payload = await requestJson(`${endpoints.price}?${query}`);
    if (
        typeof payload !== 'object' ||
        payload === null ||
        !('price' in payload) ||
        typeof payload.price !== 'string'
    ) {
        throw new Error('The server returned an invalid instrument price.');
    }

    return { price: payload.price };
}
