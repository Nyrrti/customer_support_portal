import { storeModuleFactory } from "../../js/services/store/index";
import type { User, CreateUser, UpdateUser } from "./types";
import { getRequest } from "../../js/services/http";


const baseStore = storeModuleFactory<
    User,
    CreateUser,
    UpdateUser
>("users");

export const userStore = {
    getters: baseStore.getters,
    setters: baseStore.setters,
    actions: { 
        ...baseStore.actions,
        getAdmins
    }
};


async function getAdmins(): Promise<void> {
    const { data } = await getRequest<User[]>("admins");

    for (const user of data) {
        baseStore.setters.setOne(user);
    }
}