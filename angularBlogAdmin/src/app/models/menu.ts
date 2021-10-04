export interface Menu {
    id: number,
    title: string,
    path: string,
    path_api: string,
    type: string,
    sort_order: number,
    created_at?: string,
    updated_at?: string
}