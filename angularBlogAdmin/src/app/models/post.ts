import { Category } from "./category";
import { User } from "./user";

export interface Post {
    id: number;
    title: string;
    slug: string;
    content: string;
    image?: string;
    category_id: number;
    user_id: number;
    create_at?: string;
    updated_at?: string;
    category?: Category;
    user?: User;
}