import { storeModuleFactory } from "../../js/services/store/index";
import type { Category, CreateCategory, UpdateCategory } from "./types";

export const categoryStore = storeModuleFactory<
    Category,
    CreateCategory,
    UpdateCategory
>("categories");