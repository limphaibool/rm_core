interface RoleRequest {
  name: string | null;
  parentRole: Role | null;
  enabled: boolean | null;
}
