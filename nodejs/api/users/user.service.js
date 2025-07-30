const pool = require("../../config/database");

module.exports = {
    create: (data, callBack) => {
        pool.query(
            'INSERT INTO users (name, email, password) VALUES (?, ?, ?)',
            [data.name, data.email, data.password],
            (error, results) => {
                if (error) {
                    return callBack(error);
                }
                return callBack(null, results);
            }
        );
    },

    getUserByPhone: (email, callBack) => {
        pool.query(
            'SELECT * FROM users WHERE email = ?',
            [email],
            (error, results) => {
                if (error) {
                    return callBack(error);
                }
                return callBack(null, results[0]);
            }
        );
    },



    savePosts: (data, callBack) =>{ 

        if(data.item == 'visual'){
            pool.query(
                'INSERT INTO saved_visuals (visual_id, user_id) VALUES(?, ?)',
                [data.item_id, data.user_id],
            (error, results) => {
                if (error) {
                    return callBack(error);
                }
                return callBack(null, results);
            }
            );
        }else if(data.item == 'quote'){
                        pool.query(
                'INSERT INTO saved_quotes (quote_id, user_id) VALUES(?, ?)',
                [data.item_id, data.user_id],
            (error, results) => {
                if (error) {
                    return callBack(error);
                }
                return callBack(null, results);
            }
            );
        }else if(data.item == 'audio'){
                        pool.query(
                'INSERT INTO saved_audios (audio_id, user_id) VALUES(?, ?)',
                [data.item_id, data.user_id],
            (error, results) => {
                if (error) {
                    return callBack(error);
                }
                return callBack(null, results);
            }
            );
        }

    },


getSavedPosts: (id, callBack) => {
    const queries = [
        {
            sql: `
                SELECT 
                    a.id,
                    a.name, 
                    a.img_path, 
                    a.audio_path,
                    a.view_count,
                    GROUP_CONCAT(ak.keyword) AS keywords
                FROM saved_audios sa 
                INNER JOIN audios a ON sa.audio_id = a.id
                LEFT JOIN audio_keywords ak ON ak.audio_id = a.id
                WHERE sa.user_id = ?
                GROUP BY a.id, a.name, a.img_path, a.audio_path
            `,
            values: [id]
        },
        {
            sql: `
                SELECT 
                    q.id,
                    q.is_text, 
                    q.quote,
                    q.view_count,
                    GROUP_CONCAT(qk.keyword) AS keywords
                FROM saved_quotes sq 
                INNER JOIN quotes q ON sq.quote_id = q.id
                LEFT JOIN quote_keywords qk ON qk.quote_id = q.id
                WHERE sq.user_id = ?
                GROUP BY q.id, q.is_text, q.quote
            `,
            values: [id]
        },
        {
            sql: `
                SELECT 
                    v.id,
                    v.category,
                    v.image_path,
                    v.view_count,
                    GROUP_CONCAT(vk.keyword) AS keywords
                FROM saved_visuals sv 
                INNER JOIN visual_assets v ON sv.visual_id = v.id
                LEFT JOIN visual_keywords vk ON vk.visual_id = v.id
                WHERE sv.user_id = ?
                GROUP BY v.id, v.image_path
            `,
            values: [id]
        }
    ];

    const results = {};

    pool.query(queries[0].sql, queries[0].values, (err, audioRes) => {
        if (err) return callBack(err);
        results.audios = audioRes.map(row => ({
            id: row.id,
            name: row.name,
            img_path: row.img_path,
            audio_path: row.audio_path,
            view_count: row.view_count,
            keywords: row.keywords ? row.keywords.split(',') : []
        }));

        pool.query(queries[1].sql, queries[1].values, (err, quoteRes) => {
            if (err) return callBack(err);
            results.quotes = quoteRes.map(row => ({
                id: row.id,
                is_text: row.is_text,
                quote: row.quote,
                view_count: row.view_count,
                keywords: row.keywords ? row.keywords.split(',') : []
            }));

            pool.query(queries[2].sql, queries[2].values, (err, visualRes) => {
                if (err) return callBack(err);
                results.visuals = visualRes.map(row => ({
                    id: row.id,
                    image_path: row.image_path,
                    view_count: row.view_count,
                    category: row.category,
                    keywords: row.keywords ? row.keywords.split(',') : []
                }));

                return callBack(null, results);
            });
        });
    });
},


    createNote: (data, callBack) => {
        pool.query(
            'INSERT INTO notes ( note, user_id, title) VALUES (?, ?, ?)',
            [data.note, data.user_id, data.title],
            (error, results) => {
                if (error) {
                    return callBack(error);
                }
                return callBack(null, results);
            }
        );
    },
    updateNote: (data, callBack) => {
        pool.query(
            'UPDATE notes SET note = ?, title = ? WHERE id = ? AND user_id = ?',
            [data.note, data.title, data.note_id, data.user_id],
            
            (error, results) => {
                if (error) {
                    return callBack(error);
                }
                return callBack(null, results);
            }


        );

    },
    getNotes: (user_id, callBack) => {
            pool.query(
            `SELECT id, title, note, DATE_FORMAT(created_at, '%Y-%m-%d') AS date 
            FROM notes 
            WHERE user_id = ? 
            ORDER BY created_at DESC`,
            [user_id],
            (error, results) => {
                if (error) {
                return callBack(error);
                }
                return callBack(null, results);
            }
            );


    },


getBykeyword: (keyword, options, callBack) => {
    const {
        audioLimit, audioOffset,
        quoteLimit, quoteOffset,
        visualLimit, visualOffset
    } = options;

    const queries = [
        {
            sql: `
                SELECT 
                    a.id,
                    a.name, 
                    a.img_path, 
                    a.audio_path, 
                    a.view_count,
                    GROUP_CONCAT(ak.keyword) AS keywords
                FROM audio_keywords ak 
                INNER JOIN audios a ON ak.audio_id = a.id 
                WHERE ak.keyword = ?
                GROUP BY a.id, a.name, a.img_path, a.audio_path
                LIMIT ? OFFSET ?
            `,
            values: [keyword, audioLimit, audioOffset]
        },
        {
            sql: `
                SELECT 
                    q.id,
                    q.is_text, 
                    q.quote, 
                    q.view_count,
                    GROUP_CONCAT(qk.keyword) AS keywords
                FROM quote_keywords qk 
                INNER JOIN quotes q ON qk.quote_id = q.id 
                WHERE qk.keyword = ?
                GROUP BY q.id, q.is_text, q.quote
                LIMIT ? OFFSET ?
            `,
            values: [keyword, quoteLimit, quoteOffset]
        },
        {
            sql: `
                SELECT 
                    v.id,
                    v.category,
                    v.image_path, 
                    v.view_count,
                    GROUP_CONCAT(vk.keyword) AS keywords
                FROM visual_keywords vk 
                INNER JOIN visual_assets v ON vk.visual_id = v.id 
                WHERE vk.keyword = ?
                GROUP BY v.id, v.image_path
                LIMIT ? OFFSET ?
            `,
            values: [keyword, visualLimit, visualOffset]
        }
    ];

    const results = {};

    pool.query(queries[0].sql, queries[0].values, (err, audioRes) => {
        if (err) return callBack(err);

        results.audios = audioRes.map(row => ({
            id: row.id,
            name: row.name,
            img_path: row.img_path,
            audio_path: row.audio_path,
            view_count: row.view_count,
            keywords: row.keywords ? row.keywords.split(',') : []
        }));

        pool.query(queries[1].sql, queries[1].values, (err, quoteRes) => {
            if (err) return callBack(err);

            results.quotes = quoteRes.map(row => ({
                id: row.id,
                is_text: row.is_text,
                quote: row.quote,
                view_count: row.view_count,
                keywords: row.keywords ? row.keywords.split(',') : []
            }));

            pool.query(queries[2].sql, queries[2].values, (err, visualRes) => {
                if (err) return callBack(err);

                results.visuals = visualRes.map(row => ({
                    id: row.id,
                    image_path: row.image_path,
                    view_count: row.view_count,
                    category: row.category,
                    keywords: row.keywords ? row.keywords.split(',') : []
                }));

                return callBack(null, results);
            });
        });
    });
},




updateView: (data, callBack) => {
    let sql;

    if (data.item === 'audio') {
        sql = 'UPDATE audios SET view_count = view_count + 1 WHERE id = ?';
    } else if (data.item === 'quote') {
        sql = 'UPDATE quotes SET view_count = view_count + 1 WHERE id = ?';
    } else if (data.item === 'visual') {
        sql = 'UPDATE visual_assets SET view_count = view_count + 1 WHERE id = ?';
    } else {
        return callBack(new Error("Invalid item type"));
    }

    pool.query(sql, [data.item_id], (error, results) => {
        if (error) {
            return callBack(error);
        }
        return callBack(null, results);
    });
},



};
