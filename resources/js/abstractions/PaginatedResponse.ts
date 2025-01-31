export interface PaginatedResponse<T> {
    current_page: number;
    per_page: number;
    last_page: number;
    total: number;
    data: T[];
}
