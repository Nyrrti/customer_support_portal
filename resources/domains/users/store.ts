import { storeModuleFactory } from "../../js/services/store/index";
import type { User, CreateUser, UpdateUser } from "./types";

export const userStore = storeModuleFactory<
    User,
    CreateUser,
    UpdateUser
>("users");


