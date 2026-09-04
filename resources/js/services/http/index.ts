import axios from 'axios';

// Create one reuseable Axios instance
const http = axios.create({
    // Every request made with this instance starts with "/api".
    // Adds "/api" to line
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json'
    }
});


/**
 * Sends a GET request to the given API endpoint.
 *
 * Example:
 * getRequest("/tickets")
 *
 * Because the Axios instance uses "/api" as its base URL,
 * this sends a request to "/api/tickets".
 *
 * @param endpoint - The API endpoint to request.
 * @returns The Axios response promise.
 */
export const getRequest = (endpoint: string) => http.get(endpoint);

/**
 * Sends a POST request to the given API endpoint.
 *
 * Usually used to create new data.
 *
 * @param endpoint - The API endpoint to send the request to.
 * @param data - The data that should be sent to the backend.
 * @returns The Axios response promise.
 */
export const postRequest = (endpoint: string, data) => http.post(endpoint, data);

/**
 * Sends a PUT request to the given API endpoint.
 *
 * Usually used to update existing data.
 *
 * @param endpoint - The API endpoint to send the request to.
 * @param data - The updated data that should be sent to the backend.
 * @returns The Axios response promise.
 */
export const putRequest = (endpoint: string, data) => http.put(endpoint, data);

/**
 * Sends a DELETE request to the given API endpoint.
 *
 * Usually used to remove existing data.
 *
 * @param endpoint - The API endpoint to send the request to.
 * @returns The Axios response promise.
 */
export const deleteRequest = (endpoint: string) => http.delete(endpoint);