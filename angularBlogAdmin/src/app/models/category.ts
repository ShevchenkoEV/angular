import {Post} from "./post";

export interface Category{
    id: number;
    title: string;
    slug: string;
    posts?: Post[];
    created_at?: string;
    updated_at?: string;
}
