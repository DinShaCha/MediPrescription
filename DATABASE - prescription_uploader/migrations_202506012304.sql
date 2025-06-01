INSERT INTO prescription_uploader.migrations (migration,batch) VALUES
	 ('0001_01_01_000000_create_users_table',1),
	 ('0001_01_01_000001_create_cache_table',1),
	 ('0001_01_01_000002_create_jobs_table',1),
	 ('2025_05_28_083754_add_columns_to_users_table',2),
	 ('2025_05_29_054928_create_prescriptions_table',3),
	 ('2025_05_30_060412_create_medicines_table',4),
	 ('2025_05_31_053114_add_user_id_to_prescriptions_table',5),
	 ('2025_05_31_053357_create_orders_table',6),
	 ('2025_05_31_053651_create_prescription_orders_table',7),
	 ('2025_05_31_053932_create_prescription_medicines_table',8);
INSERT INTO prescription_uploader.migrations (migration,batch) VALUES
	 ('2025_05_31_192504_change_delivery_time_column_type_in_prescriptions_table',9),
	 ('2025_06_01_152646_add_status_to_prescriptions_table',10);
