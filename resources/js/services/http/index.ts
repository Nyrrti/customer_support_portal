import axios from "axios";
import { setMessage } from "../error";

// Create one reuseable Axios instance
const http = axios.create({
    // Every request made with this instance starts with "/api".
    // Adds "/api" to line
    baseURL: "/api",
    headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
    }
});

/**
 * Handles general request errors centrally.
 *
 * Validation errors (422) continue to the calling form,
 * where their field messages can be stored.
 *
 * Failed requests remain rejected so the caller knows they failed.
 */
http.interceptors.response.use(
    (response) => response,
    (error: unknown) => {
        // Cancelling a request should not show an error message.
        if (axios.isCancel(error)) {
            return Promise.reject(error);
        }

        if (axios.isAxiosError(error)) {
            // The form will handle field validation errors.
            if (error.response?.status === 422) {
                return Promise.reject(error);
            }

            if (error.response?.status === 403) {
                setMessage("You do not have permission to access this resource.");

                return Promise.reject(error);
            }

            if (error.response?.status === 404) {
                setMessage(
                    "The requested item could not be found. It may have been deleted."
                );

                return Promise.reject(error);
            }

            if (error.response) {
                setMessage("The request failed. Please try again.");
            } else {
                setMessage(
                    "Could not reach the server. Please try again."
                );
            }
        } else {
            setMessage("An unexpected error occurred.");
        }

        return Promise.reject(error);
    }
);

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
export const getRequest = <ResponseData>(endpoint: string) => http.get<ResponseData>(endpoint);

/**
 * Sends a POST request to the given API endpoint.
 *
 * Usually used to create new data.
 *
 * @param endpoint - The API endpoint to send the request to.
 * @param data - The data that should be sent to the backend.
 * @returns The Axios response promise.
 */
export const postRequest = <ResponseData>(endpoint: string, data: unknown) => http.post<ResponseData>(endpoint, data);

/**
 * Sends a PUT request to the given API endpoint.
 *
 * Usually used to update existing data.
 *
 * @param endpoint - The API endpoint to send the request to.
 * @param data - The updated data that should be sent to the backend.
 * @returns The Axios response promise.
 */
export const putRequest = <ResponseData>(endpoint: string, data: unknown) => http.put<ResponseData>(endpoint, data);

/**
 * Sends a PATCH request to the given API endpoint.
 *
 * Used to update part of an existing resource.
 *
 * @param endpoint - The API endpoint to send the request to.
 * @param data - The fields that should be updated.
 * @returns The Axios response promise.
 */
export const patchRequest = <ResponseData>(
    endpoint: string,
    data: unknown
) => http.patch<ResponseData>(endpoint, data);

/**
 * Sends a DELETE request to the given API endpoint.
 *
 * Usually used to remove existing data.
 *
 * @param endpoint - The API endpoint to send the request to.
 * @returns The Axios response promise.
 */
export const deleteRequest = (endpoint: string) => http.delete<void>(endpoint);