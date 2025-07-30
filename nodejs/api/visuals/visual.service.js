const pool = require("../../config/database");

module.exports = {
    create: (data, callBack) => {
        pool.query(
            'INSERT INTO visual_assets (category, image_path) VALUES (?, ?)',
            [data.category, data.img_path],
            (error, results) => {
                if (error) {
                    return callBack(error);
                }
                return callBack(null, results);
            }
        );
    },
    
visualsByCategory: (category, limit, offset, callBack) => {
    const sql = `
        SELECT 
            v.id,
            v.image_path,
            v.view_count,
            GROUP_CONCAT(vk.keyword) AS keywords
        FROM 
            visual_assets v
        LEFT JOIN 
            visual_keywords vk ON v.id = vk.visual_id
        WHERE 
            v.category = ?
        GROUP BY 
            v.id
        LIMIT ? OFFSET ?
    `;

    const countQuery = `SELECT COUNT(DISTINCT v.id) AS total FROM visual_assets v WHERE v.category = ?`;

    pool.query(sql, [category, limit, offset], (error, results) => {
        if (error) return callBack(error);

        const formattedResults = results.map(row => ({
            id: row.id,
            image_path: row.image_path,
            view_count: row.view_count,
            keywords: row.keywords ? row.keywords.split(',') : []
        }));

        // Get total count
        pool.query(countQuery, [category], (countErr, countResults) => {
            if (countErr) return callBack(countErr);
            
            const totalCount = countResults[0].total;
            return callBack(null, formattedResults, totalCount);
        });
    });
},



            insertKeywrord: (data, callBack) => {
        pool.query(
            'INSERT INTO visual_keywords (visual_id, keyword) VALUES (?, ?)',
            [data.visual_id, data.keyword],
            (error, results) => {
                if (error) {
                    return callBack(error);
                }
                return callBack(null, results);
            }
        );
    },
};